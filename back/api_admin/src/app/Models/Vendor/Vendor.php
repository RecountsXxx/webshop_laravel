<?php

namespace App\Models\Vendor;

use App\Models\Product\Product;
use App\Models\VendorUsers\VendorUser;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vendor extends Model
{
    use HasFactory;

    protected $fillable = ['vendor_name','description','image'];
    public function products(){
        return $this->hasMany(Product::class);
    }
    public function vendorUser(){
        return $this->hasOne(VendorUser::class);
    }
}
