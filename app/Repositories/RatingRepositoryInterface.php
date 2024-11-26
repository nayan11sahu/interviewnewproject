<?php
namespace App\Repositories;

use App\Models\Rating;

interface RatingRepositoryInterface
{
    public function create($bookId, $rating, $userId);
}