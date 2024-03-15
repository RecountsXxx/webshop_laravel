<?php

namespace App\Repositories\JoinToVendors;

use App\Models\RequestForTheVendors\RequestForTheVendors;
use App\Repositories\BaseRepository;
use Illuminate\Support\Facades\DB;

class JoinToVendorsRepository extends BaseRepository
{
    protected $model;
    public function __construct( RequestForTheVendors $forTheVendors)
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
