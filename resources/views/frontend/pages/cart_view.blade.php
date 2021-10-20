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

                <table class="table-responsive cart-wrap table-striped">
                    <thead class="bg-success">
                        <tr class="text-bold">
                            <th>Image</th>
                            <th>Products</th>
                            <th>Unit Price(tk.)</th>
                            <th>Quantity</th>
                            <th>Total</th>
                            <th>Remove/Update</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php $total = 0; @endphp
                        @forelse ($carts as $cart)
                        <tr>
                            <td class="images">
                                <img src="{{asset('thumbnail/' . $products->created_at->format('Y/M/') . $products->id . '/'.$cart->GetProduct->thumbnail)}}"
                                    alt="{{$cart->Getproduct->title}}">
                            </td>
                            <td class="product">
                                <a href="{{route('ProductDetails',[$cart->GetProduct,$cart->GetProduct->slug])}}">
                                    <h5>{{$cart->Getproduct->title}}</h5>
                                </a>
                                <br><span>Variant:
                                    ({{'Color: '.$cart->GetColor->color_name.', Size: '.$cart->GetSize->size_name}})</span>
                            </td>
                            <td class="price">
                                {{getproductPrice($cart->product_id,$cart->color_id,$cart->size_id)->sale_price}} <span
                                    class="text-danger"> tk.</span>
                            </td>
                            <td class="quantity cart-plus-minus">
                                <form action="{{route('cart.update',$cart)}}">
                                    <input type="text" id="cart_quantity" name="quantity" value="{{$cart->quantity}}" />
                            </td>
                            <td class="total">
                                {{ getproductPrice($cart->product_id,$cart->color_id,$cart->size_id)->sale_price * $cart->quantity}}
                                <span class="text-danger"> tk.</span>
                            </td>
                            @php
                            $total +=
                            getproductPrice($cart->product_id,$cart->color_id,$cart->size_id)->sale_price*$cart->quantity;
                            @endphp
                            <td class="remove">
                                <a href="{{route('DeleteCart',$cart)}}" data-toggle="tooltip" data-placement="top"
                                    title="Remove"> <i class="fa fa-trash text-danger"></i>
                                </a>
                                <button class="ml-5 btn btn-basic" type="submit" data-toggle="tooltip"
                                    data-placement="top" title="Update"> <i class="fa fa-refresh text-success"></i>
                                </button>
                            </td>
                            </form>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="50" class="text-center display-4"><Strong> No Data Avilable</Strong> </td>
                        </tr>
                        @endforelse

                    </tbody>
                </table>
                <div class="row mt-60">
                    <div class="col-xl-4 col-lg-5 col-md-6 ">
                        <div class="cartcupon-wrap">
                            <h3>Cupon</h3>
                            <label for="coupon_name_input">Enter Your Cupon Code if You Have One</label>
                            <div id="coupon_section" class="cupon-wrap">
                                <input id="coupon_name_input" type="text" placeholder="Cupon Code"
                                    value="{{$coupon_name}}">
                                <button class="bg-success" id="coupon_name_btn">Apply Cupon</button>
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
                                <li><span class="pull-left">Subtotal </span>{{$total}} <span class="text-danger">
                                        tk.</span></li>
                                <li><span class="pull-left">Discount % @if($discount !=0)<span
                                            class="text-muted">({{$coupon_name}})</span>@endif
                                    </span>{{$discount}} <span class="text-danger"> tk.</span></li>
                                <li><span class="text-danger pull-left"> Total </span>
                                    <span class="text-danger"> {{$total-discountTotal($total,$discount)}} tk.</span>
                                    @if ($discount != 0)
                                    <p class="small text-muted pull-left">Adjusted({{$discount}}%) discount</p>
                                    @endif
                                </li>
                            </ul>
                            @php
                            session()->put('s_coupon',$coupon_name);
                            session()->put('s_subtotal',$total);
                            session()->put('s_discount',$discount);
                            session()->put('s_total',$total-discountTotal($total,$discount));
                            @endphp
                            <a class="bg-success" href="{{ route('checkout.index') }}">Proceed to Checkout</a>
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

<script>
    $(function () {
        $('[data-toggle="tooltip"]').tooltip()
     })
</script>
@endsection
