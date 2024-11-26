<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\BookRepositoryInterface;

class HomeController extends Controller
{
    protected $bookRepo;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(BookRepositoryInterface $bookRepo)
    {
        $this->middleware('auth');
        $this->bookRepo = $bookRepo;  
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(Request $request)
    {
        $title = $request->query('title');
        $author = $request->query('author');
        $books = $this->bookRepo->all($title, $author);
        return view('books.index', ['books' => $books]);
    }
}
