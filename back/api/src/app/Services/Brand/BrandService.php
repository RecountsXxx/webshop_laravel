<?php

namespace App\Services\Brand;

use App\Repositories\Brand\BrandRepository;

class BrandService
{
    public function __construct(private BrandRepository $brandRepository){}

    public function show_all()
    {
        return $this->brandRepository->all();
    }

    public function show_per_id($id)
    {
        return $this->brandRepository->findOrFail($id);
    }

    public function get_products_on_brand(string $id){
        return $this->brandRepository->get_product_on_brand($id);
    }
}
