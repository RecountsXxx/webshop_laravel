<?php

namespace App\Repositories\Product;

use App\Models\Product\Product;
use App\Repositories\BaseRepository;

class ProductRepository extends BaseRepository
{
    protected $model;
    public function __construct( Product $product)
    {
        parent::__construct($product);
        $this->model = $product;
    }


    public function getProductPerId($id)
    {
        return $this->model->with(['vendor', 'category', 'brand','images','comments.author'])->find($id);
    }
    public function getProducts()
    {
        return $this->model->with(['vendor', 'category', 'brand','images'])->paginate(12);
    }
}
