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

    public function filteredProducts($filter)
    {
        $productsQuery = Product::with(['vendor', 'category', 'brand', 'images', 'comments.author']);

        if ($filter['title']) {
            $productsQuery->where('title', 'like', '%' . $filter['title'] . '%');
        }

        if ($filter['vendor']) {
            $productsQuery->whereHas('vendor', function ($query) use ($filter) {
                $query->where('vendor_name', $filter['vendor']);
            });
        }

        if ($filter['category']) {
            $productsQuery->whereHas('category', function ($query) use ($filter) {
                $query->where('category_name', $filter['category']);
            });
        }

        if ($filter['brand']) {
            $productsQuery->whereHas('brand', function ($query) use ($filter) {
                $query->where('brand_name', $filter['brand']);
            });
        }

        if ($filter['minPrice']) {
            $productsQuery->where('price', '>=', $filter['minPrice']);
        }

        if ($filter['maxPrice']) {
            $productsQuery->where('price', '<=', $filter['maxPrice']);
        }

        if ($filter['sort'] == 'title') {
            $productsQuery->orderBy('title');
        }
        if ($filter['sort'] == 'price') {
            $productsQuery->orderBy('price');
        }
        if ($filter['sort'] == '-price') {
            $productsQuery->orderBy('price','desc');
        }

        return $productsQuery->paginate(12);
    }
}
