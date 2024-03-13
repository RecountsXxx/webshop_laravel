<?php

namespace App\Repositories\Product;

use App\Models\Product\Product;
use App\Repositories\BaseRepository;

class ProductRepository extends BaseRepository
{
    public function __construct(Product $product)
    {
        parent::__construct($product);
    }

    public function getProducts()
    {
        return $this->model->with(['vendor', 'category', 'brand','images'])->get();
    }
    public function getProduct($id)
    {
        return $this->model->with(['vendor', 'category', 'brand','images'])->findOrFail($id);
    }
}
