<?php

namespace App\Repositories\Product\Comment;
use App\Models\Product\Comment\Comment;
use App\Repositories\BaseRepository;

class CommentRepository extends BaseRepository
{
    public function __construct( Comment $comment)
    {
        parent::__construct($comment);
    }

    public function show_on_product(string $id)
    {
        return $this->model->with(['product','author'])->get()->all();
    }
}
