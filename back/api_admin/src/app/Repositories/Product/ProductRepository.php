<?php

namespace App\Repositories\Product;

use App\Models\Product\Product;
use App\Repositories\BaseRepository;
use Illuminate\Support\Facades\DB;

class ProductRepository extends BaseRepository
{
    public function __construct(Product $product)
    {
        parent::__construct($product);
    }

    public function getPaginatedProducts()
    {
        return $this->model->with(['vendor', 'category', 'brand','images'])->paginate(12);
    }

    public function getProduct($id)
    {
        return $this->model->with(['vendor', 'category', 'brand','images'])->findOrFail($id);

    }

    public function count()
    {
        return DB::table('products')->count();
    }

}
