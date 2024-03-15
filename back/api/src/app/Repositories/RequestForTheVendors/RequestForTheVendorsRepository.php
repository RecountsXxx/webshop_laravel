<?php

namespace App\Repositories\RequestForTheVendors;

use App\Models\RequestForTheVendors\RequestForTheVendors;
use App\Repositories\BaseRepository;

class RequestForTheVendorsRepository extends BaseRepository
{
    protected $model;
    public function __construct( RequestForTheVendors $forTheVendors)
    {
        parent::__construct($forTheVendors);
    }
}
