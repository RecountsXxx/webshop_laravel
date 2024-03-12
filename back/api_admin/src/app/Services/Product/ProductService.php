<?php

namespace App\Services\Product;

use App\Repositories\Admin\AdminRepository;
use App\Repositories\Product\ProductRepository;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class ProductService
{
    public function __construct(private ProductRepository $productRepository){}

    public function store(array $data,$content): Model
    {
        $product = $this->productRepository->create($data);

        $path = $product->id . '/'  . 'original.webp';
        $url = asset(Storage::url('public/product_images/' . $product->id . '/original.webp'));

        $product = $this->productRepository->findOrFail($product->id);
        $this->productRepository->update($product,['image'=> $url]);

        Storage::disk('product_images')->put($path, $content);

        return $product;
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
        return $this->productRepository->all();
    }

}
