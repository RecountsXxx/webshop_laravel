<?php

namespace App\Http\Controllers\Product;

use App\Http\Controllers\Controller;
use App\Http\Requests\Product\ProductRequest;
use App\Http\Resources\BaseWithResponseResource;
use App\Http\Resources\Errors\InternalServerErrorResource;
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
            $data = [
                'title' => $request->title,
                'description' => $request->description,
                'image' => $request->file('image'),
                'price' => $request->price,
                'category_id' => $request->category_id,
                'vendor_id' => $request->vendor_id,
                'brand_id' => $request->brand_id
            ];
            $imageContent = file_get_contents($request->file('image')->getPathname());

            $product = $this->productService->store($data,$imageContent);
            return new BaseWithResponseResource(['product'=>$product], 'created product');
        }
        catch (\Exception $e) {
            return new InternalServerErrorResource(['error' => $e->getMessage()]);
        }
    }


    public function show(string $id)
    {
        //
    }

    public function update(Request $request, string $id)
    {
        //
    }

    public function destroy(string $id)
    {
        //
    }
}
