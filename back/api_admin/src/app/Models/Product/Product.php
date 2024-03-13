<?php

namespace App\Models\Product;

use App\Models\Brand\Brand;
use App\Models\Category\Category;
use App\Models\Vendor\Vendor;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = ['title','description','image','category_id','vendor_id','brand_id','price'];
    public function brand()
    {
        return $this->belongsTo(Brand::class);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function vendor()
    {
        return $this->belongsTo(Vendor::class);
    }

    public function images(){
        return $this->hasMany(ProductImage::class);
    }
}
