<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Book;
class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home');
    }
    public function returnBack()
    {
        return redirect('/home');
    }
    public function ShowBooks()
    {
        $books =  Book::all();
        return view('show-books',compact('books'));
    }
}
