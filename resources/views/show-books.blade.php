@extends('layouts.app')

@section('content')
<div class="container">
    <p id="msg"></p>
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
                <button class="btn btn-primary btn-sm" onclick="add_cart({{$book->id}})" id="{{$book->id}}">Add Cart</button>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    <a href="/go-to-cart"><button class="btn btn-primary btn-sm float-right">Go To Cart</button></a>
</div>
<script type="text/javascript">
function add_cart(id){
    $.ajax({
               type:'GET',
               url:'/add-cart/'+id,
               success:function(data) {
                  $("#msg").html(data.message);
                  if(data.status){
                    $('#'+id).prop('disabled', true);
                  }
               }
            });
}
</script>

@endsection
