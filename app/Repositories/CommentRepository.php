<?php
namespace App\Repositories;

use App\Models\Comment;

class CommentRepository implements CommentRepositoryInterface
{
    public function allByBookId($bookId)
    {
        return Comment::where('book_id', $bookId)
            ->join('users', 'comments.user_id', '=', 'users.id')
            ->select('users.*', 'comments.*')
            ->orderBy('comments.id', 'DESC')
            ->get();
    }

    public function create($bookId, $content, $userId)
    {
        return Comment::create([
            'book_id' => $bookId,
            'user_id' => $userId,
            'content' => $content
        ]);
    }
}

