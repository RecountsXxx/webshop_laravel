<?php

namespace App\Repositories\Vendor\RequestForTheVendors;

use app\Models\Vendor\RequestForTheVendors\RequestForTheVendors;
use App\Repositories\BaseRepository;

class RequestForTheVendorsRepository extends BaseRepository
{
    protected $model;
    public function __construct( RequestForTheVendors $forTheVendors)
    {
        parent::__construct($forTheVendors);
    }
}
