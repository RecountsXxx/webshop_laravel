<?php

namespace App\Models\Product\Comment;

use App\Models\Product\Product;
use App\Models\User\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;

    protected $fillable = ['text','author_id','product_id','rating'];

    public function product(){
        return $this->belongsTo(Product::class);
    }

    public function author(){
        return $this->belongsTo(User::class);
    }
}
