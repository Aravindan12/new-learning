<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Book;

class Cart extends Model
{
    use HasFactory;
    protected $table = "carts";
    protected $fillable = ['book_id','user_id','amount'];

        public function Book()
        {
            return $this->belongsTo(Book::class, 'book_id', 'id');
        }

        
}
