@extends('frontend.master')

@section('content')
<style>
    .bgImage {
        background-image: url("{{ asset('front/images/bg/shopping.jpg' )}}");
        height: 100%;

    }
</style>
<div class="checkout-area ptb-100 bgImage">
    <div class="container">
        <span class="aler alert-success display-3 "> Product is ready for shipping.</span>


        <h1>
            <a href="{{ route('Frontend') }}">Continue shopping</a>
        </h1>
    </div>
</div>
@endsection
