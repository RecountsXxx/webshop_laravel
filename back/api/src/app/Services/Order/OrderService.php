<?php

namespace App\Services\Order;

use App\Repositories\Order\OrderRepository;

class OrderService
{
    public function __construct(private OrderRepository $orderRepository){}

    public function store($data)
    {
        return $this->orderRepository->create($data);
    }
}
