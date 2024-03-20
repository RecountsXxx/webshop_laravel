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

    public function getPaginatedVendors(){
        return $this->paginate(2);
    }

    public function get_products_on_vendor($id){
            $category = $this->findOrFail($id);
        return $category->products()->with('images')->paginate(12);

    }

}
