<?php

namespace App\Http\Controllers;

use App\Repositories\BookRepositoryInterface;
use App\Repositories\CommentRepositoryInterface;
use App\Repositories\RatingRepositoryInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BookController extends Controller
{
    protected $bookRepo;
    protected $commentRepo;
    protected $ratingRepo;

    public function __construct(
        BookRepositoryInterface $bookRepo,
        CommentRepositoryInterface $commentRepo,
        RatingRepositoryInterface $ratingRepo
    ) {
        $this->bookRepo = $bookRepo;
        $this->commentRepo = $commentRepo;
        $this->ratingRepo = $ratingRepo;
    }

    public function index(Request $request)
    {
        $title = $request->query('title');
        $author = $request->query('author');

        $books = $this->bookRepo->all($title, $author);

        return view('books.index', ['books' => $books]);
    }

    public function show(Request $request)
    {
        $id = $request->book_id;

        $book = $this->bookRepo->find($id);
        $comments = $this->commentRepo->allByBookId($id);

        return view('books.show', [
            'book' => $book,
            'comments' => $comments,
        ]);
    }

    public function addCommentstore(Request $request)
    {
        $bookId = $request->book_id;
        $content = $request->content;

        $request->validate([
            'content' => 'required'
        ]);

        $this->commentRepo->create($bookId, $content, Auth::id());

        session()->flash('success', 'Your comment has been added successfully!');

        return redirect()->back();
    }

    public function addRatingstore(Request $request)
    {
        $bookId = $request->book_id;
        $rating = $request->rating;

        $request->validate([
            'rating' => 'required|integer|between:1,5'
        ]);

        $this->ratingRepo->create($bookId, $rating, Auth::id());

        session()->flash('success', 'Your Rating has been added successfully!');

        return redirect()->back();
    }
}
