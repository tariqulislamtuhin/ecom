@extends('frontend.master')

@section('content')
<div class="checkout-area ptb-100">
    <div class="container">
        <form id="checkout_form" action="{{ url('/pay') }}" method="POST">
            @csrf
            <div class="row">
                <div class="col-lg-8">
                    <div class="checkout-form form-style">
                        <h3>Billing Details</h3>
                        <div class="row">
                            <div class="col-sm-12 col-12 form-group">
                                <label>Name *</label>
                                <input class="form-control" type="text" value="{{ $user->name }}" name="billing_name">
                                @error('billing_name')
                                <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-sm-6 col-12 form-group">
                                <label>Email Address *</label>
                                <input class="form-control @error('billing_email') is-invalid @enderror" type="email"
                                    value="{{ $user->email }}" name="billing_email">
                                @error('billing_email')
                                <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-sm-6 col-12 form-group @error('billing_phone_number') is-invalid @enderror">
                                <label>Phone No. *</label>
                                <input class="form-control" type="tel" name="billing_phone_number">
                                @error('billing_phone_number')
                                <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-6 form-group">
                                <label>Country</label>
                                <select
                                    class="form-control single_select text-center @error('country') is-invalid @enderror"
                                    id="country_dropdown" name="country">
                                    <option value="">--Select--</option>
                                    @forelse ($countries as $country)
                                    <option class="text-center" value="{{ $country->country }}">{{ $country->name }}
                                    </option>
                                    @empty

                                    @endforelse
                                </select>
                                @error('country')
                                <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-6 form-group">
                                <label>Division</label>
                                <select id="city" class="form-control text-center @error('city') is-invalid @enderror"
                                    name="city">

                                </select>
                                @error('city')
                                <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-6 form-group">
                                <label>District</label>
                                <select id="district"
                                    class="form-control text-center @error('district') is-invalid @enderror"
                                    name="district">

                                </select>
                            </div>

                            <div class="col-6 form-group">
                                <label>Thana</label>
                                <select id="thana" class="form-control text-center @error('thana') is-invalid @enderror"
                                    name="thana">

                                </select>
                            </div>

                            <div class="col-sm-6 col-12 form-group">
                                <label>Postcode/ZIP</label>
                                <input class="form-control" type="text" name="billing_postcode">
                            </div>
                            <div class="col-12 form-group">
                                <label>Your Address *</label>
                                <input class="form-control" type="text" name="billing_address">
                                @error('billing_address')
                                <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            {{-- <div class="col-sm-6 col-12 form-group">
                                <label>Town/City *</label>
                                <input class="form-control" type="text" >
                            </div> --}}
                            <div class="col-12 form-group">
                                <label>Order Notes </label>
                                <textarea class="form-control" name="order_note" id="order_note"
                                    placeholder="Notes about Your Order, e.g.Special Note for Delivery"></textarea>
                            </div>
                        </div>

                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="order-area">
                        <h3>Your Order</h3>
                        <ul class="total-cost">
                            @foreach (getCarts() as $cart)
                            <li> <img src="{{ asset('thumb/'.$cart->GetProduct->thumbnail) }}"
                                    alt="{{ $cart->getproduct->title }}" width="40">
                                <strong>{{ $cart->getproduct->title }}({{ $cart->quantity }} Picese)
                                    <span class="pull-right">
                                        {{ getproductPrice($cart->product_id,$cart->color_id,$cart->size_id)->sale_price * $cart->quantity }}৳
                                    </span></strong>
                            </li>
                            @endforeach

                            <li><strong>Subtotal <span
                                        class="pull-right">{{ session()->get('s_subtotal') }}<span>৳</span></strong></span>
                            </li>
                            <li><strong>Discount <span class="small">({{ session()->get('s_coupon') }})</span>
                                    <span class="pull-right">{{ session()->get('s_discount') }}%</strong></span>
                            </li>
                            <li><strong>Shipping <span id="shipping_cost" class="pull-right">Free</span></strong></li>
                            <li><strong>Total<span class="pull-right"
                                        id="all_total">{{ session()->get('s_total') }}</span></strong>
                            </li>
                        </ul>
                        <ul class="payment-method">
                            <li>
                                <div class="form-control text-bold radio">
                                    <input id="sslcommerz" type="radio" value="sslcommerz" name="payment_method">
                                    <label class="label label-primary" for="sslcommerz"> Pay with SSLCOMMERZ
                                        <img src="https://www.sslcommerz.com/wp-content/uploads/2020/03/favicon.png"
                                            width="25" alt="">
                                    </label>
                                </div>
                            </li>
                            <li>
                                <div class="form-control text-bold radio">
                                    <input id="cash_on_delivery" type="radio" value="cash on delivary"
                                        name="payment_method">
                                    <label class="label label-info" for="cash_on_delivery"> Cash on Delivery
                                        <img src="https://cdn-icons-png.flaticon.com/512/1554/1554401.png" width="25"
                                            alt="">
                                    </label>
                                </div>
                            </li>
                            @error('payment_method')
                            <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </ul>
                        <button type="submit" id="place_order">Place Order</button>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection
@section('footer_js')
<script>
    $(document).ready(function() {
            // $('.single_select').select2();
            $("#country_dropdown").change(function(){
                var country_code = $('#country_dropdown').val();
                var total = "{{ session()->get('s_total') }}";
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });

                $.ajax({
                    type: 'POST',
                    url:'get/city/list',
                    data: {country_code: country_code},
                    success: function(res){
                        $("#city").empty();
                        $("#city").append('<option value="">--Select One--</option>');
                        let options = "";
                        $.each(res,function (key,value) {
                            options += '<option value="'+value.id+'">'+value.name+'</option>';
                        });
                        $("#city").append(options);
                    }
                });

                $("#city").change(function(){


                    if (country_code == 'BD') {
                        $("#shipping_cost").html(120+"৳");
                        $("#all_total").html((120 + parseInt(total))+" ৳");

                    }else{
                        $("#shipping_cost").html(500+"৳");
                        $("#all_total").html((500 + parseInt(total))+" ৳");
                    }
                    var city_id = $("#city").val();
                    $.ajaxSetup({
                        headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        }
                    });
                    $.ajax({
                        type: 'POST',
                        url:'get/district/list',
                        data: {city_id: city_id,country_code: country_code},
                        success: function(res){
                            $("#district").empty();
                            $("#district").append('<option>--Select One--</option>');
                            let options = '';
                            $.each(res,function (key,value) {
                                options += '<option value="'+value.id+'">'+value.name+'</option>';
                            });
                            $("#district").append(options);
                        }
                    });


                    $("#district").change(function(){

                        var district_id = $("#district").val();
                        $.ajaxSetup({
                            headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                            }
                        });
                        $.ajax({
                            type: 'POST',
                            url:'get/thana/list',
                            data: {country_code: country_code,district_id: district_id},
                            success: function(res){
                               if(res){
                                    $("#thana").empty();
                                    $("#thana").append('<option value="">--Select One--</option>');
                                    let options = "";
                                    $.each(res,function (key,value) {
                                            options += '<option value="'+value.id+'">'+value.name+'</option>';
                                    });
                                    $("#thana").append(options);
                               }else{
                                    $("#thana").empty();
                                    $("#thana").append('<option>--Not Available--</option>');
                               }
                            }
                        });
                    });


                });


            });


            $("#sslcommerz").change(function(){
                $("#checkout_form").attr("action","{{ url('/pay') }}");
            });
            $("#cash_on_delivery").change(function(){
                $("#checkout_form").attr("action","{{ url('checkout/store') }}");
            });

            $("#checkout_form").submit(function(e){
                @php
                    session()->put("s_shipping",200);
                @endphp
            });

    });
</script>
@endsection
