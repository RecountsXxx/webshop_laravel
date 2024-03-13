<?php

namespace App\Services\Product;

use App\Models\Product\Product;
use App\Repositories\Admin\AdminRepository;
use App\Repositories\Product\ProductImagesRepository;
use App\Repositories\Product\ProductRepository;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class ProductService
{
    public function __construct(private ProductRepository $productRepository, private ProductImagesRepository $imagesRepository){}


    public function store(array $data): Product
    {
        $product = $this->productRepository->create($data);
        return $product;
    }

    public function uploadImages($id, $imageContent,$key)
    {
            $path = $id . '/' . 'image_' . $key . '.webp';
            Storage::disk('product_images')->put($path, $imageContent);
            $path = asset('storage/product_images/' . $id . '/image_' . $key . '.webp');

        $this->imagesRepository->create(['product_id' => $id, 'image' => $path]);
    }


    public function destroy(string $id)
    {
        $product = $this->productRepository->findOrFail($id);
        $this->productRepository->delete($product);
    }

    public function update(array $data): Model
    {
        $product = $this->productRepository->update($data);
        return $this->productRepository->findOrFail($product->$data['id']);
    }
    public function index()
    {
        return $this->productRepository->getProducts();
    }

}
