<?php

namespace App\Repositories\Vendor\JoinToVendors;

use App\Models\Vendor\JoinToVendors\JoinToVendors;
use App\Repositories\BaseRepository;
use Illuminate\Support\Facades\DB;

class JoinToVendorsRepository extends BaseRepository
{
    protected $model;
    public function __construct( JoinToVendors $forTheVendors)
    {
        parent::__construct($forTheVendors);
    }

    public function getPaginateRequests()
    {
        return $this->paginate(12);
    }
    public function count()
    {
        return DB::table('request_for_the_vendors')->count();
    }
}
