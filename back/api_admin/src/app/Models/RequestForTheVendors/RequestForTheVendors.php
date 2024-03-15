<?php

namespace App\Models\RequestForTheVendors;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RequestForTheVendors extends Model
{
    use HasFactory;

    protected $fillable = ['email','shop_name','description','info'];
}
