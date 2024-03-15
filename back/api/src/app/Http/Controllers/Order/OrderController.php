<?php

namespace App\Http\Controllers\Order;

use App\Http\Controllers\Controller;
use App\Http\Requests\Order\OrderRequest;
use App\Http\Resources\BaseWithResponseResource;
use App\Http\Resources\Errors\InternalServerErrorResource;
use App\Services\Order\OrderService;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function __construct(private OrderService $orderService){}

    public function __invoke(OrderRequest $orderRequest)
    {
        $data = [
            'full_name'=>$orderRequest->full_name,
            'address'=>$orderRequest->address,
            'email'=>$orderRequest->email,
            'type_payment'=>$orderRequest->type_payment,
            'product_id'=>$orderRequest->product_id,
            'vendor_id'=>$orderRequest->vendor_id,
        ];
        try {
            $this->orderService->store($data);
            return new BaseWithResponseResource(['order'=>null], 'create order','200');
        }
        catch (\Exception $e) {
            return new InternalServerErrorResource(['error' => $e->getMessage()]);
        }
    }
}
