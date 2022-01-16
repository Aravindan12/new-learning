@extends('layouts.app')

@section('content')
<div class="container">
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
                <button  class="btn btn-primary btn-sm" name="amount"
                id="payment_stripe"
                value="{{$book->price}}"
                data-key="{{Config::get('services.stripe.secret')}}"
                data-amount="{{$book->price * 100}}"
                data-currency="{{env('CASHIER_CURRENCY')}}"
                data-name="Pay"
                data-description=""
                onclick="stripe(this);">Buy Now</button>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
<script>
    async function stripe(this_dt) {
            //console.log(this_dt)
                var amount = $("#payment_stripe").data('amount');
                event.preventDefault();
                var $button = $("#payment_stripe");
                console.log($('#payment_stripe').attr('data-key'));
                var data = {};
                data.amount = $('#payment_stripe').attr('data-amount');
                data.key = $('#payment_stripe').attr('data-key');
                data.currency = $('#payment_stripe').attr('data-currency');
                data.name = $('#payment_stripe').attr('data-name');
                var opts = $.extend({}, data, {
                    token: function (result) {
                        console.log(result)
                        //console.log(result.id);
                        $(this).data('description', 'Take Screenshot for Verification');
                        $("#payment_form").append($('<input>').attr({type: 'hidden', name: 'amount', value: amount}));
                        $("#payment_form").append($('<input>').attr({type: 'hidden', name: 'result', value: result}));
                        $("#payment_form").append($('<input>').attr({
                            type: 'hidden',
                            name: 'stripeToken',
                            value: result.id
                        }));
                        var form_data = new FormData($("#payment_form")[0]);
                        var val21 = $(".total_amount21").attr("data-val");
                        form_data.append('wallet_price', val21);
                        $(".loader_datas").show();
                        console.log(form_data)
                        $.ajax({
                            type: 'post',
                            url: 'register-save',
                            data: form_data,
                            cache: false,
                            contentType: false,
                            processData: false,
                            dataType: 'json',
                            success: function (result, status) {
                                console.log(result.status);
                                if (result.status == "error") {
                                    $("#err_data").html(result.msg);
                                }
                                if (result.status == "success") {
                                    $("#err_data").html("");
                                    window.location.assign(result.url);

                                }
                            }
                        })
                    }
                });
                StripeCheckout.open(opts);
            }
</script>
<script src="https://checkout.stripe.com/v2/checkout.js"></script>

@endsection
