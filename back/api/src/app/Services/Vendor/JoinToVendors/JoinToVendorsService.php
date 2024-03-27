<?php

namespace App\Services\Vendor\JoinToVendors;

use App\Repositories\Vendor\JoinToVendors\JoinToVendorsRepository;

class JoinToVendorsService
{
    public function __construct(private JoinToVendorsRepository $forTheVendorsRepository){}
    public function store($data)
    {
        $this->forTheVendorsRepository->create($data);
    }
}
