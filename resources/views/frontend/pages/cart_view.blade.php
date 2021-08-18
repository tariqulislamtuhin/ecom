@extends('frontend.master')

@section("content")

<!-- .breadcumb-area start -->
<div class="breadcumb-area bg-img-4 ptb-100">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="breadcumb-wrap text-center">
                    <h2>Shopping Cart</h2>
                    <ul>
                        <li><a href="{{route('Frontend')}}">Home</a></li>
                        <li><span>Shopping Cart</span></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- .breadcumb-area end -->
<!-- cart-area start -->
<div class="cart-area ptb-100">
    <div class="container">
        <div class="row">
            <div class="col-12">

                <table class="table-responsive cart-wrap">
                    <thead class="bg-danger">
                        <tr>
                            <th class="images">Image</th>
                            <th class="product">Products</th>
                            <th class="ptice">Price(Per Unit)</th>
                            <th class="quantity">Quantity</th>
                            <th class="total">Total</th>
                            <th class="remove">Remove</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php $total = 0; @endphp
                        @forelse ($carts as $cart)
                        <tr>
                            <td class="images">
                                <img src="{{asset('thumb/'.$cart->GetProduct->thumbnail)}}"
                                    alt="{{$cart->Getproduct->title}}">
                            </td>
                            <td class="product"><a
                                    href="{{route('ProductDetails',[$cart->GetProduct->slug,$cart->product_id])}}">{{$cart->Getproduct->title}}</a>
                                <br><span>({{'Color: '.$cart->GetColor->color_name.', Size: '.$cart->GetSize->size_name}})</span>
                            </td>
                            <td class="price">
                                {{getproductPrice($cart->product_id,$cart->color_id,$cart->size_id)->sale_price}}
                            </td>
                            <td class="quantity cart-plus-minus">
                                <input type="text" value="{{$cart->quantity}}" />
                            </td>
                            <td class="total">
                                {{ getproductPrice($cart->product_id,$cart->color_id,$cart->size_id)->sale_price * $cart->quantity}}
                            </td>
                            @php
                            $total += getproductPrice($cart->product_id,$cart->color_id,$cart->size_id)->sale_price
                            * $cart->quantity; @endphp
                            <td class="remove">
                                <a href="{{route('DeleteCart',$cart->id)}}"> <i class="fa fa-trash text-danger"></i>
                                </a>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="50" class="text-center"> No Data Avilable </td>
                        </tr>
                        @endforelse

                    </tbody>
                </table>
                <div class="row mt-60">
                    <div class="col-xl-4 col-lg-5 col-md-6 ">
                        <div class="cartcupon-wrap">
                            <ul class="d-flex">
                                <li>
                                    <button>Update Cart</button>
                                </li>
                                <li><a href="shop.html">Continue Shopping</a></li>
                            </ul>
                            <h3>Cupon</h3>
                            <p>Enter Your Cupon Code if You Have One</p>
                            <div id="coupon_section" class="cupon-wrap">
                                <input id="coupon_name_input" type="text" placeholder="Cupon Code"
                                    value="{{$coupon_name}}">
                                <button id="coupon_name_btn">Apply Cupon</button>
                            </div>
                            @if (session('coupon_error'))
                            <span class="text-danger">{{session('coupon_error')}}</span>
                            @endif
                        </div>
                    </div>
                    <div class="col-xl-3 offset-xl-5 col-lg-4 offset-lg-3 col-md-6">
                        <div class="cart-total text-right">
                            <h3>Cart Totals</h3>
                            <ul>
                                <li><span class="pull-left">Subtotal </span>{{$total}}</li>
                                <li><span class="pull-left">Discount({{$discount}}%)</span>{{$discount}}</li>
                                <li><span class="pull-left"> Total </span>
                                    {{discountTotal($total,$discount)}}
                                    <p class="small pull-left">Adjusted({{$discount}}%) discount
                                    </p>
                                </li>
                            </ul>
                            <a href="checkout.html">Proceed to Checkout</a>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>
<!-- cart-area end -->


@endsection

@section('footer_js')

<script>
    $("#coupon_name_btn").click(function(){
        var coupon_name = $("#coupon_name_input").val();
        var coupon_address = "{{url('/carts')}}/"+coupon_name;
        window.location.href = coupon_address;
    });
</script>
@endsection
