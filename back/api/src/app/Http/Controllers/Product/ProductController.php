<?php

namespace App\Http\Controllers\Product;

use App\Http\Controllers\Controller;
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
            $products =  $this->productService->show_all();
            return new BaseWithResponseResource(['products'=>$products], 'show products','200');
        }
        catch (\Exception $e) {
            return new InternalServerErrorResource(['error' => $e->getMessage()]);
        }
    }

    public function show(string $id){
        try {
            $products =  $this->productService->show_product($id);
            return new BaseWithResponseResource(['product'=>$products], 'show one product','200');
        }
        catch (\Exception $e) {
            return new InternalServerErrorResource(['error' => $e->getMessage()]);
        }
    }

    public function filteredProducts(Request $request)
    {
        try {
            $filter = [
                'title' => $request->title,
                'vendor' => $request->vendor,
                'category' => $request->category,
                'brand' => $request->brand,
                'minPrice' => $request->minPrice,
                'maxPrice' => $request->maxPrice,
                'sort' => $request->sort,
            ];

            $products = $this->productService->filteredProducts($filter);
            return new BaseWithResponseResource(['products'=>$products], 'show one product','200');
        }
        catch (\Exception $e) {
            return new InternalServerErrorResource(['error' => $e->getMessage()]);
        }
    }


}
