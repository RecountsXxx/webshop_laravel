<?php

namespace App\Services\RequestForTheVendors;

use App\Repositories\RequestForTheVendors\RequestForTheVendorsRepository;

class RequestForTheVendorsService
{
    public function __construct(private RequestForTheVendorsRepository $forTheVendorsRepository){}

    public function store($data)
    {
        $this->forTheVendorsRepository->create($data);
    }
}
