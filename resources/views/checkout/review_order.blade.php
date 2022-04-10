@extends('frontEnd.layouts.master')
@section('title','Review Order Page')
@section('slider')
@endsection
@section('content')
    <div class="container">
        <div class="step-one">
            <h2 class="heading">Shipping To</h2>
        </div>
        <div class="row">
            <form action="{{url('/submit-order')}}" method="post" class="form-horizontal">
                <input type="hidden" name="_token" value="{{csrf_token()}}">

                <input type="hidden" name="users_id" value="{{$shipping_address->users_id}}">
                <input type="hidden" name="users_email" value="{{$shipping_address->users_email}}">
                <input type="hidden" name="name" value="{{$shipping_address->name}}">
                <input type="hidden" name="address" value="{{$shipping_address->address}}">
                <input type="hidden" name="city" value="{{$shipping_address->city}}">
                <input type="hidden" name="state" value="{{$shipping_address->state}}">
                <input type="hidden" name="pincode" value="{{$shipping_address->pincode}}">
                <input type="hidden" name="country" value="{{$shipping_address->country}}">
                <input type="hidden" name="mobile" value="{{$shipping_address->mobile}}">
                <input type="hidden" name="shipping_charges" value="0">
                <input type="hidden" name="order_status" value="success">
                @if(Session::has('discount_amount_price'))
                    <input type="hidden" name="coupon_code" value="{{Session::get('coupon_code')}}">
                    <input type="hidden" name="coupon_amount" value="{{Session::get('discount_amount_price')}}">
                    <input type="hidden" name="grand_total" value="{{$total_price-Session::get('discount_amount_price')}}">
                @else
                    <input type="hidden" name="coupon_code" value="NO Coupon">
                    <input type="hidden" name="coupon_amount" value="0">
                    <input type="hidden" name="grand_total" value="{{$total_price}}">
                @endif

                <div class="col-sm-12">
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead>
                            <tr>
                                <th>Name</th>
                                <th>Address</th>
                                <th>City</th>
                                <th>State</th>
                                <th>Country</th>
                                <th>Pincode</th>
                                <th>Mobile</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr>
                                <td>{{$shipping_address->name}}</td>
                                <td>{{$shipping_address->address}}</td>
                                <td>{{$shipping_address->city}}</td>
                                <td>{{$shipping_address->state}}</td>
                                <td>{{$shipping_address->country}}</td>
                                <td>{{$shipping_address->pincode}}</td>
                                <td>{{$shipping_address->mobile}}</td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                    <section id="cart_items">
                        <div class="review-payment">
                            <h2>Review & Payment</h2>
                        </div>
                        <div class="table-responsive cart_info">
                            <table class="table table-condensed">
                                <thead>
                                <tr class="cart_menu">
                                    <td class="image">Item</td>
                                    <td class="description"></td>
                                    <td class="price">Price</td>
                                    <td class="quantity">Quantity</td>
                                    <td class="total">Total</td>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($cart_datas as $cart_data)
                                    <?php
                                    $image_products=DB::table('products')->select('image')->where('id',$cart_data->products_id)->get();
                                    ?>
                                    <tr>
                                    <td class="cart_product">
                                        @foreach($image_products as $image_product)
                                            <a href=""><img src="{{url('products/small',$image_product->image)}}" alt="" style="width: 100px;"></a>
                                        @endforeach
                                    </td>
                                    <td class="cart_description">
                                        <h4><a href="">{{$cart_data->product_name}}</a></h4>
                                        <p>{{$cart_data->product_code}} | {{$cart_data->size}}</p>
                                    </td>
                                    <td class="cart_price">
                                        <p>${{$cart_data->price}}</p>
                                    </td>
                                    <td class="cart_quantity">
                                        <p>{{$cart_data->quantity}}</p>
                                    </td>
                                    <td class="cart_total">
                                        <p class="cart_total_price">$ {{$cart_data->price*$cart_data->quantity}}</p>
                                    </td>
                                </tr>
                                @endforeach
                                <tr>
                                    <td colspan="4">&nbsp;</td>
                                    <td colspan="2">
                                        <table class="table table-condensed total-result">
                                            <tr>
                                                <td>Cart Sub Total</td>
                                                <td>$ {{$total_price}}</td>
                                            </tr>
                                            @if(Session::has('discount_amount_price'))
                                                <tr class="shipping-cost">
                                                    <td>Coupon Discount</td>
                                                    <td>$ {{Session::get('discount_amount_price')}}</td>
                                                </tr>
                                                <tr>
                                                    <td>Total</td>
                                                    <td><span>$ {{$total_price-Session::get('discount_amount_price')}}</span></td>
                                                </tr>
                                            @else
                                                <tr>
                                                    <td>Total</td>
                                                    <td><span>$ {{$total_price}}</span></td>
                                                </tr>
                                            @endif
                                        </table>
                                    </td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                        <div class="payment-options">
                            <span>Select Payment Method : </span>
                        <span>
                            <label><input type="radio" name="payment_method" value="COD" checked> Cash On Delivery</label>
                        </span>
                            <span>
                            <label><input type="radio" name="payment_method" value="Paypal"> Paypal</label>
                        </span>
                            <button type="submit" class="btn btn-primary" style="float: right;">Order Now</button>
                        </div>
                    </section>

                </div>
            </form>
        </div>
    </div>
    <div style="margin-bottom: 20px;"></div>
@endsection