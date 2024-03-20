<?php

namespace App\Services\Product\Comment;

use App\Repositories\Product\Comment\CommentRepository;
use App\Repositories\Product\ProductRepository;

class CommentService
{
    public function __construct(private CommentRepository $commentRepository, private ProductRepository $productRepository){}

    public function store($data)
    {
        return $this->commentRepository->create($data);
    }

    public function show_on_product(string $id)
    {
        return $this->commentRepository->show_on_product($id);
    }
}
