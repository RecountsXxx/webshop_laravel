<?php

namespace App\Models\Brand;

use App\Models\Product\Product;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Brand extends Model
{
    use HasFactory;

    protected $fillable = ['brand_name','description','image'];
    public function products()
    {
        return $this->hasMany(Product::class);
    }
}
