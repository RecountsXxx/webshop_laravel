<?php

namespace App\Repositories\Vendor;

use App\Models\Vendor\Vendor;
use App\Repositories\BaseRepository;
use Illuminate\Support\Facades\DB;

class VendorRepository extends BaseRepository
{
    public function __construct( Vendor $vendor)
    {
        parent::__construct($vendor);
    }
    public function getPaginateVendors()
    {
        return $this->paginate(12);
    }

    public function count()
    {
        return DB::table('vendors')->count();
    }

}
