<?php

namespace App\Http\Controllers\Vendor\RequestForTheVendors;

use App\Http\Controllers\Controller;
use App\Http\Requests\RequestForTheVendors\RequestForTheVendorsRequest;
use App\Http\Resources\BaseWithResponseResource;
use App\Http\Resources\Errors\InternalServerErrorResource;
use App\Services\Vendor\RequestForTheVendors\RequestForTheVendorsService;

class RequestForTheVendorsController extends Controller
{
    public function __construct(private RequestForTheVendorsService $forTheVendorsService){}

    public function __invoke(RequestForTheVendorsRequest $request)
    {
        $data = [
            'shop_name'=>$request->shop_name,
            'email'=>$request->email,
            'description'=>$request->description,
        ];
        try {
            $this->forTheVendorsService->store($data);
            return new BaseWithResponseResource(['request'=>null], 'create request for join vendors','200');
        }
        catch (\Exception $e) {
            return new InternalServerErrorResource(['error' => $e->getMessage()]);
        }
    }
}