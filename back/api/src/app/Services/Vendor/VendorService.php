<?php

namespace App\Services\Vendor;

use App\Repositories\Vendor\VendorRepository;

class VendorService
{
    public function __construct(private VendorRepository $vendorRepository){}

    public function show_all()
    {
        return $this->vendorRepository->all();
    }

    public function show_per_id($id)
    {
        return $this->vendorRepository->findOrFail($id);
    }

    public function get_products_on_vendor(string $id){
        return $this->vendorRepository->get_products_on_vendor($id);
    }
}
