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

        <div class="card">
            <div class="card-header">
                <h1 class="text-center">Order is ready for shipping.</h1>
            </div>
            <div class="card-body">
                <h1 class="text-center">
                    <a href="{{ route('Frontend') }}"><img
                            src="https://i.pinimg.com/originals/df/03/fc/df03fc5c32b309a299bc95260089b0cd.gif"
                            width="500" alt=""></a>
                </h1>
            </div>
            <div class="card-footer">
                <h3 class="text-center">Happy Shopping!</h3>
            </div>
        </div>


    </div>
</div>

@endsection
