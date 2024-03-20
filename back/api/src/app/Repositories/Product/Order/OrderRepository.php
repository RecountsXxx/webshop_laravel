<?php

namespace App\Repositories\Product\Order;
use App\Models\Product\Order\Order;
use App\Repositories\BaseRepository;

class OrderRepository extends BaseRepository
{
    public function __construct( Order $order)
    {
        parent::__construct($order);
    }
}
