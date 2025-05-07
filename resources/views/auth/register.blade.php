@extends('admin.layouts.guest')

@section('title', 'Register || Booking Management System')

@section('main')
    <div class="register-logo"> <a href="#"><b>Admin</b>LTE</a> </div> <!-- /.register-logo -->
    <div class="card">
        <div class="card-body register-card-body">
            <p class="register-box-msg">Register a new membership</p>
            @if (session('message'))
                <div class="alert alert-danger">
                    {{ session('message') }}
                </div>
            @endif
            <form action="{{ route('register') }}" method="post">
                @csrf
                <div class="input-group mb-3"> <input type="text" class="form-control @error('name') is-invalid @enderror"
                        placeholder="Name" name="name" value="{{ old('name') }}">
                    <div class="input-group-text"> <span class="bi bi-person"></span> </div>
                </div>
                @error('name')
                    <p class="text-danger">{{ $message }}</p>
                @enderror
                <div class="input-group mb-3"> <input type="email"
                        class="form-control @error('email') is-invalid @enderror" placeholder="Email" name="email"
                        value="{{ old('email') }}">
                    <div class="input-group-text"> <span class="bi bi-envelope"></span> </div>
                </div>
                @error('email')
                    <p class="text-danger">{{ $message }}</p>
                @enderror
                <div class="input-group mb-3"> <input type="password"
                        class="form-control @error('password') is-invalid @enderror" placeholder="Password" name="password"
                        value="{{ old('password') }}">
                    <div class="input-group-text"> <span class="bi bi-lock-fill"></span> </div>
                </div>
                @error('password')
                    <p class="text-danger">{{ $message }}</p>
                @enderror
                <div class="input-group mb-3"> <input type="password" class="form-control" placeholder="Confirm Password"
                        name="password_confirmation">
                    <div class="input-group-text"> <span class="bi bi-lock-fill"></span> </div>
                </div>
                @error('password')
                    <p class="text-danger">{{ $message }}</p>
                @enderror
                <!--begin::Row-->
                <div class="row">
                    <div class="col-8">
                        <div class="form-check"> <input class="form-check-input" type="checkbox" value=""
                                id="flexCheckDefault">
                            <label class="form-check-label" for="flexCheckDefault">
                                I agree to the <a href="#">terms</a> </label>
                        </div>
                    </div> <!-- /.col -->
                    <div class="col-4">
                        <div class="d-grid gap-2"> <button type="submit" class="btn btn-primary">Sign In</button>
                        </div>
                    </div> <!-- /.col -->
                </div> <!--end::Row-->
            </form>
            {{-- <div class="social-auth-links text-center mb-3 d-grid gap-2">
                <p>- OR -</p> <a href="#" class="btn btn-primary"> <i class="bi bi-facebook me-2"></i> Sign in
                    using Facebook
                </a> <a href="#" class="btn btn-danger"> <i class="bi bi-google me-2"></i> Sign in using Google+
                </a>
            </div> <!-- /.social-auth-links --> --}}
            <p class="mb-0"> <a href="{{ route('login') }}" class="text-center">
                    I already have an account
                </a> </p>
        </div> <!-- /.register-card-body -->
    </div>
@endsection
