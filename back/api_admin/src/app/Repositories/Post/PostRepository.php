<?php

namespace App\Repositories\Post;

use App\Models\Post\Post;
use App\Repositories\BaseRepository;
use Illuminate\Support\Facades\DB;

class PostRepository extends BaseRepository
{
    public function __construct(Post $post)
    {
        parent::__construct($post);
    }

    public function getPaginatedPosts()
    {
        return $this->paginate(12);
    }

    public function count()
    {
        return DB::table('posts')->count();
    }
}
