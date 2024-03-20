<?php

namespace App\Services\Vendor\RequestForTheVendors;

use App\Repositories\Vendor\RequestForTheVendors\RequestForTheVendorsRepository;

class RequestForTheVendorsService
{
    public function __construct(private RequestForTheVendorsRepository $forTheVendorsRepository){}
    public function store($data)
    {
        $this->forTheVendorsRepository->create($data);
    }
}
