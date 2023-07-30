@extends('layouts.app')

@section('style')
    <link rel="stylesheet" href="{{ asset('css/auth.css') }}">
@endsection

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-4">
            <div class="card bg-white shadow px-2">
                <div class="img-container mt-4 mx-auto">
                    <img src="{{asset('images/logo.png')}}" alt="logo" width="60">
                </div>
                <div class="card-body">
                    @if ($errors->any())
                            <div class="card card-body p-2 mb-4 rounded text-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                    <form method="POST" action="{{ route('register') }}">
                        @csrf
                        <div class="input-gp mt-2 mb-3">
                            <input id="name" type="text" class="auth-input @error('name') border border-2 border-danger @enderror"
                                name="name" value="{{ old('name') }}" required="">
                            <label for="" class="label">Enter Name</label>
                        </div>
                        @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                        @enderror
                        <div class="input-gp mt-2 mb-3">
                            <input id="email" type="text" class="auth-input @error('email') border border-2 border-danger @enderror"
                                name="email" value="{{ old('email') }}" required="">
                            <label for="" class="label">Enter Email</label>
                        </div>
                        @error('number')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                        @enderror
                        <div class="input-gp mt-2 mb-3">
                            <input id="number" type="text" class="auth-input @error('number') border border-2 border-danger @enderror"
                                name="number" value="{{ old('number') }}" required="">
                            <label for="" class="label">Enter Phone Number</label>
                        </div>
                        @error('address')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                        @enderror
                        <div class="input-gp mt-2 mb-3">
                            <input id="address" type="text" class="auth-input @error('address') border border-2 border-danger @enderror"
                                name="address" value="{{ old('address') }}" required="">
                            <label for="" class="label">Enter Address</label>
                        </div>
                        <div class="input-gp mt-2 mb-3">
                            <input id="password" type="password" class="auth-input @error('password') is-invalid @enderror"
                                name="password" value="{{ old('password') }}" required="">
                            <label for="" class="label">Enter password</label>
                            <i class="fa-solid fa-eye eye-icon"></i>
                        </div>
                        <div class="input-gp mt-2 mb-3">
                            <input id="password_confirmation" type="password" class="auth-input @error('password_confirmation') is-invalid @enderror"
                                name="password_confirmation" value="{{ old('password_confirmation') }}" required="">
                            <label for="" class="label">Enter Confirm Password</label>
                            <i class="fa-solid fa-eye eye-icon"></i>
                        </div>

                        <div class="row mb-0">
                            <div class="col-sm-12">
                                <button type="submit" class="btn btn-primary w-100 fw-semibold fs-5">
                                    {{ __('Register') }}
                                </button>
                            </div>
                        </div>
                    </form>
                    <p class="mb-0 mt-3">Already have an account ?<a href="{{route('login')}}"> Login Here</a></p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
