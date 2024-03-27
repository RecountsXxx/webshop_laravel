<?php

namespace App\Models\Post;

use App\Models\Category\Category;
use App\Models\Post\PostOperations\Comment;
use App\Models\User\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

   protected $fillable = ['title','text','likes_count','views_count'];
}
