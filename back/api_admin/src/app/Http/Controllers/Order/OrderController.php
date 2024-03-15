<?php

namespace App\Http\Controllers\Order;

use App\Http\Controllers\Controller;
use App\Http\Resources\BaseWithResponseResource;
use App\Http\Resources\Errors\InternalServerErrorResource;
use App\Services\Order\OrderService;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function __construct(private OrderService $orderService){}

    public function index()
    {
        try {
            $orders = $this->orderService->index();
            return new BaseWithResponseResource(['orders'=>$orders], 'show orders', '200');
        } catch (\Exception $e) {
            return new InternalServerErrorResource(['error' => $e->getMessage()]);
        }
    }
    public function destroy(string $id)
    {
        try {
            $this->orderService->destroy($id);
            return new BaseWithResponseResource(['order'=>null], 'delete order', '200');
        } catch (\Exception $e) {
            return new InternalServerErrorResource(['error' => $e->getMessage()]);
        }
    }
}
