@extends('frontend.master')

@section('content')
<div class="checkout-area ptb-100">
    <div class="container">
        <div class="aler alert-success">
            Product is ready to be shippied
        </div>
        <h1>
            <a href="{{ route('Frontend') }}">Continue shopping</a>
        </h1>
    </div>
</div>
@endsection
