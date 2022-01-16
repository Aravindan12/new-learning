<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Book;

class Books extends Component
{
    public $books, $book_name, $price, $author,$book_id;
    public $updateMode = false;

    public function render()
    {
        $this->books = Book::all();
        return view('livewire.books');
    }

    private function resetInputFields(){
        $this->book_name = '';
        $this->price = '';
        $this->author = '';
    }
   
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    public function store()
    {
        $validatedDate = $this->validate([
            'book_name' => 'required',
            'price' => 'required',
            'author' => 'required',
        ]);
  
        Book::create($validatedDate);
  
        session()->flash('message', 'Book Created Successfully.');
  
        $this->resetInputFields();
    }
  
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    public function edit($id)
    {
        $book = Book::findOrFail($id);
        $this->book_id = $id;
        $this->book_name = $book->book_name;
        $this->price = $book->price;
        $this->author = $book->author;
  
        $this->updateMode = true;
    }
  
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    public function cancel()
    {
        $this->updateMode = false;
        $this->resetInputFields();
    }
  
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    public function update()
    {
        $validatedDate = $this->validate([
            'book_name' => 'required',
            'price' => 'required',
            'author' => 'required',
        ]);
  
        $book = Book::find($this->book_id);
        $book->update([
            'book_name' => $this->book_name,
            'price' =>  $this->price,
            'author' =>  $this->author,
        ]);
  
        $this->updateMode = false;
  
        session()->flash('message', 'Book Updated Successfully.');
        $this->resetInputFields();
    }
   
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    public function delete($id)
    {
        Book::find($id)->delete();
        session()->flash('message', 'Post Deleted Successfully.');
    }
}
