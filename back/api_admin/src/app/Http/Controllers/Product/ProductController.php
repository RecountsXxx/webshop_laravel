<?php

namespace App\Http\Controllers\Product;

use App\Http\Controllers\Controller;
use App\Http\Requests\Product\AddImageRequest;
use App\Http\Requests\Product\ProductRequest;
use App\Http\Requests\Product\UpdateProductRequest;
use App\Http\Resources\BaseWithResponseResource;
use App\Http\Resources\Errors\InternalServerErrorResource;
use App\Jobs\Product\AddOneProductImageJob;
use App\Services\Product\ProductService;

class ProductController extends Controller
{
    public function __construct(private ProductService $productService){}

    public function index()
    {
        try {
            $products = $this->productService->index();
            return new BaseWithResponseResource(['products' => $products], 'show products');
        } catch (\Exception $e) {
            return new InternalServerErrorResource(['error' => $e->getMessage()]);
        }
    }


    public function store(ProductRequest $request)
    {
        try {
            $data = [
                'title' => $request->title,
                'description' => $request->description,
                'price' => $request->price,
                'new_price' => $request->new_price,
                'count'=>$request->count,
                'category_id' => $request->category_id,
                'vendor_id' => $request->vendor_id,
                'brand_id' => $request->brand_id,
            ];
            $product =$this->productService->store($data);

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

    public function update(UpdateProductRequest $request, string $id)
    {
        try {
            $data = [
                'title' => $request->title,
                'description' => $request->description,
                'price' => $request->price,
                'new_price' => $request->new_price,
                'count'=>$request->count,
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

            $image = AddOneProductImageJob::dispatch($data)->onQueue('upload.images.jobs');
            return new BaseWithResponseResource(['image' => 'asd'], 'add image');
        } catch (\Exception $e) {
            return new InternalServerErrorResource(['error' => $e->getMessage()]);
        }
    }
}
