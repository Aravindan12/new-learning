<form>
    <input type="hidden" wire:model="book_id">
    <div class="form-group">
        <label for="exampleFormControlInput1">Book Name:</label>
        <input type="text" class="form-control" id="exampleFormControlInput1" placeholder="Enter Book Name" wire:model="book_name">
        @error('title') <span class="text-danger">{{ $message }}</span>@enderror
    </div>
    <div class="form-group">
        <label for="exampleFormControlInput2">Price:</label>
        <input type="number" class="form-control" id="exampleFormControlInput2" wire:model="price" placeholder="Enter price">
        @error('body') <span class="text-danger">{{ $message }}</span>@enderror
    </div>
    <div class="form-group">
        <label for="exampleFormControlInput2">Author:</label>
        <input type="text" class="form-control" id="exampleFormControlInput2" wire:model="author" placeholder="Enter Author Name">
        @error('body') <span class="text-danger">{{ $message }}</span>@enderror
    </div>
    <button wire:click.prevent="update()" class="btn btn-dark">Update</button>
    <button wire:click.prevent="cancel()" class="btn btn-danger">Cancel</button>
</form>