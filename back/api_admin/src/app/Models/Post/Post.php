<?php

namespace App\Models\Post;

use App\Models\Category\Category;
use App\Models\User\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    protected $table='posts';
   protected $fillable = ['title','text','image','likes_count','views_count'];
}
