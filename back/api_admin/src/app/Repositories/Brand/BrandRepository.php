<?php

namespace App\Repositories\Brand;

use App\Models\Brand\Brand;
use App\Repositories\BaseRepository;

class BrandRepository extends BaseRepository
{
    public function __construct( Brand $brand)
    {
        parent::__construct($brand);
    }

    public function get_product_on_brand($brand_id)
    {
        $brand = $this->findOrFail($brand_id);
        return $brand->products;
    }

}
