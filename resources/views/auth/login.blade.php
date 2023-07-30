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
                        <img src="{{ asset('images/logo.png') }}" alt="logo" width="60">
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
                        <form method="POST" action="{{ route('login') }}">
                            @csrf

                            <div class="input-gp mt-2 mb-3">
                                <input id="email" type="text" class="auth-input @error('email') border border-2 border-danger @enderror"
                                    name="email" value="{{ old('email') }}" required="">
                                <label for="" class="label">Enter Email</label>
                            </div>

                            <div class="input-gp mt-4 mb-3">
                                <input id="password" type="password"
                                    class="auth-input " name="password"
                                    required="">
                                <label for="" class="label">Enter Password</label>
                                <i class="fa-solid fa-eye eye-icon"></i>
                            </div>
                            <button class="btn btn-primary w-100 fs-5 fw-semibold" type="submit">Login</button>
                        </form>
                        <p class="mb-0 mt-3">Do not have an account ?<a href="{{ route('register') }}"> Register Here</a>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection


