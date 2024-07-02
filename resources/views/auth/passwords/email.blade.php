@extends('layouts.app')

@section('content')

    <!-- ===============================================-->
    <!--    Main Content-->
    <!-- ===============================================-->
    <main class="main" id="top">
        <div class="container-fluid">
            <div class="row min-vh-100 flex-center g-0">
                <div class="col-lg-8 col-xxl-7 py-3 position-relative">
                    <img class="bg-auth-circle-shape" src="{{ asset('img/car-x-assets/shape-1.png') }}" alt="" width="150">
                    <img class="bg-auth-circle-shape-2" src="{{ asset('img/car-x-assets/shape-1.png') }}" alt="" width="150">
                    <div class="card z-1">
                        <div class="card-body p-0">
                            <div class="row g-0 h-100">
                                <div class="col-md-5 text-center car-x-theme-dark">
                                    <div class="position-relative p-4 pt-md-5 pb-md-7" data-bs-theme="light">
                                        <div class="bg-holder bg-auth-card-shape" style="background-image: url('{{ asset('icons/spot-illustrations/half-circle.png') }}');">
                                        </div>
                                        <!--/.bg-holder-->

                                        <div class="z-1 position-relative login-logo">
                                            <img src="{{ asset('img/car-x-assets/logo.png') }}" alt="logo">
                                            <p class="opacity-75 text-white">This portal is provided to Car-X dealers as a means to extend
                                                exceptional service and value to customers.</p>
                                            <p class="opacity-75 text-white">Please contact the Car-X National office for instruction on
                                                access and participation.</p>
                                        </div>
                                    </div>

                                </div>
                                <div class="col-md-7 d-flex flex-center">
                                    <img class="cards-bird" src="{{ asset('img/car-x-assets/birds.png') }}" alt="birds">
                                    @if (session('status'))
                                        <div class="alert alert-success" role="alert">
                                            {{ session('status') }}
                                        </div>
                                    @endif
                                    <div class="p-4 p-md-5 flex-grow-1">
                                        <div class="text-center text-md-start">
                                            <h4 class="mb-0"> Forgot your password?</h4>
                                            <p class="mb-4">Enter your email and we'll send you a reset link.</p>
                                        </div>
                                        <div class="row justify-content-center">
                                            <div class="col-sm-8 col-md">
                                                <form method="POST" action="{{ route('password.email') }}" class="mb-3">
                                                    @csrf
                                                    <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                                                    @error('email')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                    @enderror
                                                    <div class="mb-3"></div>
                                                    <button type="submit" class="btn btn-primary d-block w-100 mt-3" name="submit">
                                                        {{ __('Send Password Reset Link') }}
                                                    </button>
                                                </form>
                                            </div>
                                            <a class="fs--1 text-600" href="{{ url('/login') }}"><span class="d-inline-block ms-1">&#8592;</span> Go Back To Login</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
    <!-- ===============================================-->
    <!--    End of Main Content-->
    <!-- ===============================================-->


@endsection
