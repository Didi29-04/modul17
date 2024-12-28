@extends('layouts.no-nav')

@section('content')
<div class="d-flex justify-content-center align-items-center" style="height: 100vh; background-color: #007bff;">
    <div class="card shadow" style="width: 400px; border-radius: 8px; background-color: white;">
        <div class="card-body text-center p-5">
            <div class="mb-2">
                <i class="bi-hexagon-fill" style="color: #007bff; font-size: 50px;"></i>
            </div>
            <h3 class="fw-bold mb-5">Employee Data Master</h3>

            <hr style="border-top: 3px solid #c9c9c9; margin-bottom: 15px;">
            <form method="POST" action="{{ route('login') }}">
                @csrf

                <div class="form-group mb-3">
                    <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus placeholder="Enter Your Email">

                    @error('email')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                <div class="form-group mb-2">
                    <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password" placeholder="Enter Your Password">

                    @error('password')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                <hr style="border-top: 3px solid #c9c9c9; margin-bottom: 30px;">

                <button type="submit" class="btn btn-primary w-100" style="padding: 10px 0; font-size: 16px;">
                    <i class="bi bi-box-arrow-in-right me-1"></i> Log In
                </button>

            </form>
        </div>
    </div>
</div>

@endsection

