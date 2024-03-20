<?php

namespace App\Services\Product\Order;

use App\Repositories\Product\Order\OrderRepository;

class OrderService
{
    public function __construct(private OrderRepository $orderRepository){}
    public function store($data)
    {
        return $this->orderRepository->create($data);
    }
}
