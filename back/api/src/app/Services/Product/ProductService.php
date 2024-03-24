<?php

namespace App\Services\Product;

use App\Repositories\Product\ProductRepository;

class ProductService
{
    public function __construct(private ProductRepository $productRepository){}
    public function show_all()
    {
        return $this->productRepository->getProducts();
    }

    public function show_product($product_id)
    {
        return $this->productRepository->getProductPerId($product_id);
    }

    public function filteredProducts($filter){
        return $this->productRepository->filteredProducts($filter);
    }
}
