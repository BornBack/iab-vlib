<?php

namespace App\Http\Livewire;

use App\Models\Book;
use Livewire\Component;
use Livewire\WithPagination;

class Books extends Component
{
    use WithPagination;
    public $search;
    public $perPage = 12;


    public function getBooksProperty(){
        return Book::when($this->search >= 2 , function ($query){
            $this->resetPage();
            $query->orWhere("name", 'LIKE', '%' . $this->search . '%');
            $query->orWhere("author", 'LIKE', '%' . $this->search . '%');
            $query->orWhere("publication", 'LIKE', '%' . $this->search . '%');
            return $query;
        })
        ->latest()
        ->paginate($this->perPage);
    }

    public function read(Book $book){
        $book->increment("read");
    }

    public function render()
    {
        return view('livewire.books');
    }
}
