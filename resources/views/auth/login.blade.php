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
                                    <div class="p-4 p-md-5 flex-grow-1">
                                        <div class="row flex-between-center">
                                            <div class="col-auto">
                                                <h3>Account Login</h3>
                                            </div>
                                        </div>
                                        <form method="POST" action="{{ route('login') }}">
                                            @csrf
                                            <div class="mb-3">
                                                <label class="form-label" for="card-email">Email address</label>
                                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                                                @error('email')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                            <div class="mb-3">
                                                <div class="d-flex justify-content-between">
                                                    <label class="form-label" for="card-password">Password</label>
                                                </div>
                                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">

                                                @error('password')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror

                                            </div>
                                            <div class="row flex-between-center">
                                                <div class="col-auto">
                                                    <div class="form-check mb-0">
                                                        <input class="form-check-input" type="checkbox" id="card-checkbox" checked="checked" />
                                                        <label class="form-check-label mb-0" for="card-checkbox">Remember me</label>
                                                    </div>
                                                </div>
                                                <div class="col-auto">

                                                    @if (Route::has('password.request'))
                                                        <a class="btn btn-link fs-10" href="{{ route('password.request') }}">
                                                            {{ __('Forgot Password?') }}
                                                        </a>
                                                    @endif
                                                </div>

                                            </div>
                                            <div class="mb-3">
                                                <button type="submit" class="btn btn-primary  d-block w-100 mt-3" name="submit">
                                                    {{ __('Login') }}
                                                </button>

                                            </div>
                                        </form>

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
