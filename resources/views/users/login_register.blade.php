@extends('frontEnd.layouts.master')
@section('title','Login Register Page')
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
            <div class="col-sm-4 col-sm-offset-1">
                <div class="login-form"><!--login form-->
                    <h2>Login to your account</h2>
                    <form action="{{url('/user_login')}}" method="post" class="form-horizontal">
                        <input type="hidden" name="_token" value="{{csrf_token()}}">
                        <input type="email" placeholder="Email" name="email"/>
                        <input type="password" placeholder="Password" name="password"/>
                        <span>
                            <input type="checkbox" class="checkbox">
                            Keep me signed in
                        </span>
                        <button type="submit" class="btn btn-default">Login</button>
                    </form>
                </div><!--/login form-->
            </div>
            <div class="col-sm-1">
                <h2 class="or">OR</h2>
            </div>
            <div class="col-sm-4">
                <div class="signup-form"><!--sign up form-->
                    <h2>New User Signup!</h2>
                    <form action="{{url('/register_user')}}" method="post" class="form-horizontal">
                        <input type="hidden" name="_token" value="{{csrf_token()}}">

                        <input type="text" placeholder="Name" name="name" value="{{old('name')}}"/>
                        <span class="text-danger">{{$errors->first('name')}}</span>

                        <input type="email" placeholder="Email Address" name="email" value="{{old('email')}}"/>
                        <span class="text-danger">{{$errors->first('email')}}</span>

                        <input type="password" placeholder="Password" name="password" value="{{old('password')}}"/>
                        <span class="text-danger">{{$errors->first('password')}}</span>

                        <input type="password" placeholder="Confirm Password" name="password_confirmation" value="{{old('password_confirmation')}}"/>
                        <span class="text-danger">{{$errors->first('password_confirmation')}}</span>

                        <button type="submit" class="btn btn-default">Signup</button>
                    </form>
                </div><!--/sign up form-->
            </div>
        </div>
    </div>
    <div style="margin-bottom: 20px;"></div>
@endsection