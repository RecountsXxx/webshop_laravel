<?php

namespace App\Http\Controllers\Product;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Http\Requests\Product\ProductRequest;
use App\Http\Resources\BaseWithResponseResource;
use App\Http\Resources\Errors\InternalServerErrorResource;
use App\Repositories\Product\ProductRepository;
use App\Services\Product\ProductService;

class ProductController extends Controller
{
    public function __construct(private ProductService $productService){}

    public function index()
    {
        try {
            $products =  $this->productService->show_all();
            return new BaseWithResponseResource(['products'=>$products], 'show products','200');
        }
        catch (\Exception $e) {
            return new InternalServerErrorResource(['error' => $e->getMessage()]);
        }
    }

    public function show(ProductRequest $request){
        try {
            $products =  $this->productService->show_product($request->id);
            return new BaseWithResponseResource(['product'=>$products], 'show one product','200');
        }
        catch (\Exception $e) {
            return new InternalServerErrorResource(['error' => $e->getMessage()]);
        }
    }
}
