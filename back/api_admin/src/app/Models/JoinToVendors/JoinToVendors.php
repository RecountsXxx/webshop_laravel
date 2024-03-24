<?php

namespace App\Models\JoinToVendors;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JoinToVendors extends Model
{
    use HasFactory;

    protected $table = 'request_for_the_vendors';
    protected $fillable = ['email','shop_name','description','info'];
}
