<?php

namespace App\Services\Product;

use App\Models\Product\Product;
use App\Repositories\Admin\AdminRepository;
use App\Repositories\Product\ProductImagesRepository;
use App\Repositories\Product\ProductRepository;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Storage;

class ProductService
{
    public function __construct(private ProductRepository $productRepository, private ProductImagesRepository $imagesRepository){}


    public function store(array $data): Product
    {
        $product = $this->productRepository->create($data);
        return $product;
    }

    public function uploadImages($id, $imageContent)
    {
        usleep(1000000);
        $fileName = 'image_'  . time() . '.webp';

        $path = $id . '/' . $fileName;
        Storage::disk('product_images')->put($path, $imageContent);
        $url = asset('storage/product_images/' . $path);
        $this->imagesRepository->create(['product_id' => $id, 'image' => $url]);
    }


    public function show(string $id){
        return $this->productRepository->getProduct($id);
    }
    public function destroy(string $id)
    {
        $product = $this->productRepository->findOrFail($id);
        $this->productRepository->delete($product);
    }

    public function update(array $data,$id): Model
    {
        $product = $this->productRepository->findOrFail($id);
        $this->productRepository->update($product,$data);
        return $this->productRepository->findOrFail($product->id);
    }
    public function index()
    {
        return $this->productRepository->getProducts();
    }
    public function delete_image($id)
    {
        $image = $this->imagesRepository->findOrFail($id);
        if (Storage::disk('product_images')->exists($image->image)) {
            Storage::disk('product_images')->delete($image->image);
        }
        $this->imagesRepository->delete($image);
    }
    public function add_image($id, $imageContent)
    {
        usleep(1000000);
        $fileName = 'image_' . time() . '.webp';
        $path = $id . '/' . $fileName;
        Storage::disk('product_images')->put($path, $imageContent);
        $url = asset('storage/product_images/' . $path);
        $image = $this->imagesRepository->create(['product_id' => $id, 'image' => $url]);
    }



}
