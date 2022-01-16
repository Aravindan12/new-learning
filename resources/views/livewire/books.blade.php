<div>
    {{-- The whole world belongs to you. --}}
    @if (session()->has('message'))
        <div class="alert alert-success">
            {{ session('message') }}
        </div>
    @endif
  
    @if($updateMode)
        @include('livewire.update')
    @else
        @include('livewire.create')
    @endif
  
    <table class="table table-bordered mt-5">
        <thead>
            <tr>
                <th>No.</th>
                <th>Title</th>
                <th>Price</th>
                <th>Author</th>
                <th width="150px">Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach($books as $book)
            <tr>
                <td>{{ $loop->index+1 }}</td>
                <td>{{ $book->book_name }}</td>
                <td>{{ $book->price }}</td>
                <td>{{ $book->author }}</td>
                <td>
                <button wire:click="edit({{ $book->id }})" class="btn btn-primary btn-sm">Edit</button>
                    <button wire:click="delete({{ $book->id }})" class="btn btn-danger btn-sm">Delete</button>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
