@extends('layouts.login')

@section('title')
    Login
@endsection

@section('content')
    <!-- ======= main ======= -->
    <section class="my-login-page">
        <div class="container form-Bg">

            <div class="row justify-content-md-center">
                <div class="card-wrapper">
                    <div class="brand">
                        <img src="{{ url('frontend/images/lock.png') }}" alt="logo" />
                    </div>
                    <div class="card fat">
                        <div class="card-body">
                            {{-- login --}}
                            <h4 class="card-title text-center">Login</h4>
                            <form action="{{ route('login.index') }}" method="POST" class="my-login-validation"
                                novalidate="">
                                @csrf
                                <div class="mb-3">
                                    <label for="username" class="form-label">Username or Email</label>
                                    <input id="username" type="text"
                                        class="form-control @error('username') is-invalid @enderror" name="username"
                                        value="" required autofocus placeholder="Input username or email" />
                                    <div class="invalid-feedback">Email is invalid</div>
                                </div>

                                @error('username')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror

                                <div class="mb-3">
                                    <label for="password" class="form-label">Password </label>
                                    <input id="password" type="password"
                                        class="form-control  @error('password') is-invalid @enderror" name="password"
                                        required data-eye placeholder="Input password" />
                                    <div class="invalid-feedback">Password is required</div>
                                </div>

                                @error('password')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror

                                <div class="mb-3 form-check">
                                    <input type="checkbox" name="remember" id="remember" class="form-check-input" />
                                    <label for="remember" class="form-check-label" name="remember">Remember Me</label>
                                </div>

                                <div class="m-0 d-grid">
                                    <button type="submit" class="btn btn-primary btn-block">
                                        Login
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="footer">Copyright &copy; {{ now()->year }} &mdash; Taunur</div>
                </div>
            </div>
        </div>
    </section>
@endsection
