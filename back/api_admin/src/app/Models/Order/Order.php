<?php

namespace App\Models\Order;

use App\Models\Product\Product;
use App\Models\Vendor\Vendor;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected  $fillable = ['full_name','type_payment','address','email','product_id','vendor_id'];

    use HasFactory;


    public function product(){
       return $this->belongsTo(Product::class);
    }
    public function vendor()
    {
        return $this->belongsTo(Vendor::class);
    }
}
