<?php

namespace App\Http\Controllers\Product;

use App\Http\Controllers\Controller;
use App\Http\Requests\Product\AddImageRequest;
use App\Http\Requests\Product\ProductRequest;
use App\Http\Resources\BaseWithResponseResource;
use App\Http\Resources\Errors\InternalServerErrorResource;
use App\Jobs\AddOneProductImageJob;
use App\Jobs\UploadProductImageJob;
use App\Services\Product\ProductService;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function __construct(private ProductService $productService){}

    public function index()
    {
        try {
            $products = $this->productService->index();
            return new BaseWithResponseResource(['products'=>$products], 'show products');
        }
        catch (\Exception $e) {
            return new InternalServerErrorResource(['error' => $e->getMessage()]);
        }
    }

    public function store(ProductRequest $request)
    {
        try {
            $imagePaths = [];

            foreach ($request->file('images') as $image) {
                $imagePath = $image->store('images');
                $imagePaths[] = $imagePath;
            }

            $data = [
                'title' => $request->title,
                'description' => $request->description,
                'price' => $request->price,
                'category_id' => $request->category_id,
                'vendor_id' => $request->vendor_id,
                'brand_id' => $request->brand_id,
                'image_paths' => $imagePaths
            ];

            $product = UploadProductImageJob::dispatch($data)->onQueue('upload.images.jobs');

            return new BaseWithResponseResource(['product' => $product], 'created product');
        } catch (\Exception $e) {
            return new InternalServerErrorResource(['error' => $e->getMessage()]);
        }
    }



    public function show(string $id)
    {
        try {
            $product = $this->productService->show($id);
            return new BaseWithResponseResource(['product' => $product], 'show product');
        } catch (\Exception $e) {
            return new InternalServerErrorResource(['error' => $e->getMessage()]);
        }
    }

    public function update(ProductRequest $request, string $id)
    {
        try {
            $data = [
                'title' => $request->title,
                'description' => $request->description,
                'price' => $request->price,
                'category_id' => $request->category_id,
                'vendor_id' => $request->vendor_id,
                'brand_id' => $request->brand_id,
            ];

            $this->productService->update($data,$id);

            return new BaseWithResponseResource(['product' => 'updated'], 'created product');
        } catch (\Exception $e) {
            return new InternalServerErrorResource(['error' => $e->getMessage()]);
        }
    }

    public function destroy(string $id)
    {
        try {
             $this->productService->destroy($id);
            return new BaseWithResponseResource(['product' =>'deleted'], 'delete product');
        } catch (\Exception $e) {
            return new InternalServerErrorResource(['error' => $e->getMessage()]);
        }
    }

    public function delete_image(string $id)
    {
        try {
            $this->productService->delete_image($id);
            return new BaseWithResponseResource(['image' =>'deleted'], 'delete image');
        } catch (\Exception $e) {
            return new InternalServerErrorResource(['error' => $e->getMessage()]);
        }
    }
    public function add_image(AddImageRequest $request)
    {
        $image_path = $request->file('image')->store('images');
        try {
            $data = [
                'product_id'=>$request->product_id,
                'image_path'=>$image_path,
            ];
            AddOneProductImageJob::dispatch($data)->onQueue('upload.images.jobs');
            return new BaseWithResponseResource(['image' =>'added'], 'add image');
        } catch (\Exception $e) {
            return new InternalServerErrorResource(['error' => $e->getMessage()]);
        }
    }
}
