@extends('layouts.app')

@section('content')
<div class="container">
    <table class="table table-bordered mt-5">
        <thead>
            <tr>
                <th>No.</th>
                <th>Title</th>
                <th>Price</th>
            </tr>
        </thead>
        <tbody>
            @foreach($carts as $cart)
            <tr>
                <td>{{ $loop->index+1 }}</td>
                <td>{{ $cart->Book->book_name }}</td>
                <td>{{ $cart->Book->price }}</td>
            </tr>
            @endforeach
            <tr>
                <td colspan="2">Total : </td>
                <td>{{$total}}</td>
            </tr>
        </tbody>
    </table>
<form action="checkout" method="POST">
    @csrf
    <input type="hidden" name="amount" value="{{$total}}">
    <input type="hidden" name="currency" value="INR">
    <button type="submit" class="btn btn-primary btn-sm float-right">Pay now</button>
</form>
</div>

<script type="text/javascript">
$(document).ready(function(){


})
    </script>
@endsection
