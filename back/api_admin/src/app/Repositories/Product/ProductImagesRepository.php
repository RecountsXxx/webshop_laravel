<?php

namespace App\Repositories\Product;

use App\Models\Product\Product;
use App\Models\Product\ProductImage;
use App\Repositories\BaseRepository;

class ProductImagesRepository extends BaseRepository
{
    public function __construct(ProductImage $product)
    {
        parent::__construct($product);
    }
}
