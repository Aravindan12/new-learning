<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Book;
use App\Models\Cart;
use Auth;
class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(Book $book,Cart $cart)
    {
        $this->middleware('auth');
        $this->book = $book;
        $this->cart = $cart;
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
    public function addCart($id)
    {
        $book = Book::where('id',$id)->first();
        $userId = Auth::id();
        $cart = Cart::insert(['book_id'=>$id,'user_id'=>$userId,'amount'=>$book->price]);
        return response()->json(['status'=>true,'message'=>'done']);
    }
    public function goToCart()
    {
        $userId = Auth::id();
        $total = 0;
        $carts = Cart::with('Book')->where('user_id',$userId)->get();
        foreach($carts as $cart){
            $total += $cart->Book->price;
        }
        return view('cart',compact('carts','total'));
    }
}
