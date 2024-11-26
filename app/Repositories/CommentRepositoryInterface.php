<?php
namespace App\Repositories;

use App\Models\Comment;

interface CommentRepositoryInterface
{
    public function allByBookId($bookId);
    public function create($bookId, $content, $userId);
}