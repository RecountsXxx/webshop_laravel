<?php

namespace App\Repositories\Vendor;

use App\Models\Vendor\Vendor;
use App\Repositories\BaseRepository;

class VendorRepository extends BaseRepository
{
    public function __construct( Vendor $vendor)
    {
        parent::__construct($vendor);
    }

    public function get_products_on_vendor($id){
        $vendor = $this->findOrFail($id);
        return $vendor->products;
    }

}
