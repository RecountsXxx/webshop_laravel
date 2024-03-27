<?php

namespace App\Repositories\Vendor\JoinToVendors;

use App\Models\Vendor\RequestForTheVendors\RequestForTheVendors;
use App\Repositories\BaseRepository;

class JoinToVendorsRepository extends BaseRepository
{
    protected $model;
    public function __construct( RequestForTheVendors $forTheVendors)
    {
        parent::__construct($forTheVendors);
    }
}
