<?php

namespace App\Repositories\Order;
use App\Models\Order\Order;
use App\Repositories\BaseRepository;
use Illuminate\Support\Facades\DB;

class OrderRepository extends BaseRepository
{
    public function __construct( Order $order)
    {
        parent::__construct($order);
    }

    public function getPaginateOrders()
    {
        return $this->model->with(['product','vendor'])->paginate(12);
    }
    public function count()
    {
        return DB::table('orders')->count();
    }
}
