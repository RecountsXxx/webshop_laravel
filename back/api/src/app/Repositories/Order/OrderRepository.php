<?php

namespace App\Repositories\Order;
use App\Models\Order\Order;
use App\Repositories\BaseRepository;

class OrderRepository extends BaseRepository
{
    public function __construct( Order $order)
    {
        parent::__construct($order);
    }
}
