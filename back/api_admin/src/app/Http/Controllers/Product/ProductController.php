<?php

namespace App\Http\Controllers\Product;

use App\Http\Controllers\Controller;
use App\Http\Requests\Product\ProductRequest;
use App\Http\Resources\BaseWithResponseResource;
use App\Http\Resources\Errors\InternalServerErrorResource;
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

            // Обрабатываем каждое изображение из запроса
            foreach ($request->file('images') as $image) {
                $imagePath = $image->store('images');
                $imagePaths[] = $imagePath;
            }

            // Добавляем данные о продукте и пути к изображениям в массив
            $data = [
                'title' => $request->title,
                'description' => $request->description,
                'price' => $request->price,
                'category_id' => $request->category_id,
                'vendor_id' => $request->vendor_id,
                'brand_id' => $request->brand_id,
                'image_paths' => $imagePaths // Массив путей к изображениям
            ];

            UploadProductImageJob::dispatch($data)->onQueue('upload.images.jobs');

            return new BaseWithResponseResource(['product' => null], 'created product');
        } catch (\Exception $e) {
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
