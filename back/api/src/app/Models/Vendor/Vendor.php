<?php

namespace App\Models\Vendor;

use App\Models\Product\Product;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vendor extends Model
{
    use HasFactory;

    public function products(){
        return $this->hasMany(Product::class);
    }
}
