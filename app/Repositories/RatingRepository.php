<?php
namespace App\Repositories;

use App\Models\Rating;

class RatingRepository implements RatingRepositoryInterface
{
    public function create($bookId, $rating, $userId)
    {
        return Rating::create([
            'book_id' => $bookId,
            'user_id' => $userId,
            'rating' => $rating
        ]);
    }
}