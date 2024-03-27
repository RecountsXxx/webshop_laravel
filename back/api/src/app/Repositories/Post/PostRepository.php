<?php

namespace App\Repositories\Post;

use App\Models\Post\Post;
use App\Repositories\BaseRepository;

class PostRepository extends BaseRepository
{
    //сделать под репозиторий
    public function __construct(private Post $post)
    {
        parent::__construct($post);
    }
    public function getPaginatedPosts()
    {
     return $this->paginate(12);
    }
}
