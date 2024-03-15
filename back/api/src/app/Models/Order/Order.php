<?php

namespace App\Models\Order;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected  $fillable = ['full_name','type_payment','address','email','product_id','vendor_id'];

    use HasFactory;
}
