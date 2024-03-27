<?php

namespace App\Services\Product\Order;

use App\Repositories\Product\Order\OrderRepository;

class OrderService
{
    public function __construct(private OrderRepository $orderRepository){}

    public function index()
    {
        return $this->orderRepository->getPaginateOrders();
    }

    public function destroy($id)
    {
        $order = $this->orderRepository->findOrFail($id);
        $this->orderRepository->delete($order);
    }
}
