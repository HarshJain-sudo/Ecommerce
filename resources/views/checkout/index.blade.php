@extends('frontEnd.layouts.master')
@section('title','checkOut Page')
@section('slider')
@endsection
@section('content')
    <div class="container">
        @if(Session::has('message'))
            <div class="alert alert-success text-center" role="alert">
                {{Session::get('message')}}
            </div>
        @endif
        <div class="row">
            <form action="{{url('/submit-checkout')}}" method="post" class="form-horizontal">
                <div class="col-sm-4 col-sm-offset-1">
                    <div class="login-form"><!--login form-->
                        <input type="hidden" name="_token" value="{{csrf_token()}}">
                        <legend>Billing To</legend>
                        <div class="form-group {{$errors->has('billing_name')?'has-error':''}}">
                            <input type="text" class="form-control" name="billing_name" id="billing_name" value="{{$user_login->name}}" placeholder="Billing Name">
                            <span class="text-danger">{{$errors->first('billing_name')}}</span>
                        </div>
                        <div class="form-group {{$errors->has('billing_address')?'has-error':''}}">
                            <input type="text" class="form-control" value="{{$user_login->address}}" name="billing_address" id="billing_address" placeholder="Billing Address">
                            <span class="text-danger">{{$errors->first('billing_address')}}</span>
                        </div>
                        <div class="form-group {{$errors->has('billing_city')?'has-error':''}}">
                            <input type="text" class="form-control" name="billing_city" value="{{$user_login->city}}" id="billing_city" placeholder="Billing City">
                            <span class="text-danger">{{$errors->first('billing_city')}}</span>
                        </div>
                        <div class="form-group {{$errors->has('billing_state')?'has-error':''}}">
                            <input type="text" class="form-control" name="billing_state" value="{{$user_login->state}}" id="billing_state" placeholder=" Billing State">
                            <span class="text-danger">{{$errors->first('billing_state')}}</span>
                        </div>
                        <div class="form-group">
                            <select name="billing_country" id="billing_country" class="form-control">
                                @foreach($countries as $country)
                                    <option value="{{$country->country_name}}" {{$user_login->country==$country->country_name?' selected':''}}>{{$country->country_name}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group {{$errors->has('billing_pincode')?'has-error':''}}">
                            <input type="text" class="form-control" name="billing_pincode" value="{{$user_login->pincode}}" id="billing_pincode" placeholder=" Billing Pincode">
                            <span class="text-danger">{{$errors->first('billing_pincode')}}</span>
                        </div>
                        <div class="form-group {{$errors->has('billing_mobile')?'has-error':''}}">
                            <input type="text" class="form-control" name="billing_mobile" value="{{$user_login->mobile}}" id="billing_mobile" placeholder="Billing Mobile">
                            <span class="text-danger">{{$errors->first('billing_mobile')}}</span>
                        </div>

                        <span>
                            <input type="checkbox" class="checkbox" name="checkme" id="checkme">Shipping Address same as Billing Address
                        </span>
                    </div><!--/login form-->
                </div>
                <div class="col-sm-1">

                </div>
                <div class="col-sm-4">
                    <div class="signup-form"><!--sign up form-->
                        <legend>Shipping To</legend>
                        <div class="form-group {{$errors->has('shipping_name')?'has-error':''}}">
                            <input type="text" class="form-control" name="shipping_name" id="shipping_name" value="" placeholder="Shipping Name">
                            <span class="text-danger">{{$errors->first('shipping_name')}}</span>
                        </div>
                        <div class="form-group {{$errors->has('shipping_address')?'has-error':''}}">
                            <input type="text" class="form-control" value="" name="shipping_address" id="shipping_address" placeholder="Shipping Address">
                            <span class="text-danger">{{$errors->first('shipping_address')}}</span>
                        </div>
                        <div class="form-group {{$errors->has('shipping_city')?'has-error':''}}">
                            <input type="text" class="form-control" name="shipping_city" value="" id="shipping_city" placeholder="Shipping City">
                            <span class="text-danger">{{$errors->first('shipping_city')}}</span>
                        </div>
                        <div class="form-group {{$errors->has('shipping_state')?'has-error':''}}">
                            <input type="text" class="form-control" name="shipping_state" value="" id="shipping_state" placeholder="Shipping State">
                            <span class="text-danger">{{$errors->first('shipping_state')}}</span>
                        </div>
                        <div class="form-group">
                            <select name="shipping_country" id="shipping_country" class="form-control">
                                @foreach($countries as $country)
                                    <option value="{{$country->country_name}}">{{$country->country_name}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group {{$errors->has('shipping_pincode')?'has-error':''}}">
                            <input type="text" class="form-control" name="shipping_pincode" value="" id="shipping_pincode" placeholder="Shipping Pincode">
                            <span class="text-danger">{{$errors->first('shipping_pincode')}}</span>
                        </div>
                        <div class="form-group {{$errors->has('shipping_mobile')?'has-error':''}}">
                            <input type="text" class="form-control" name="shipping_mobile" value="" id="shipping_mobile" placeholder="Shipping Mobile">
                            <span class="text-danger">{{$errors->first('shipping_mobile')}}</span>
                        </div>
                        <button type="submit" class="btn btn-primary" style="float: right;">CheckOut</button>
                    </div><!--/sign up form-->
                </div>
            </form>
        </div>
    </div>
    <div style="margin-bottom: 20px;"></div>
@endsection