@extends('blog.layouts.main')
@section('content')
    {{-- make a login form her with email, password and login button, remember me checkbox, forgot password link and signup link in body center, dont need to show label like Email or Password but need to show it placeholder in input like Email: --}}

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card mt-0">
                    <div class="text-center">
                        <h1>Login</h1>
                        <hr>
                    </div>
                    <div class="card-body">
                        @if (session('error_msg'))
                            <div class="alert alert-danger text-center">{{ session('error_msg') }}</div>
                        @endif
                        <form action="{{ route('front.login') }}" method="POST">
                            @csrf
                            <div class="form-group">
                                <label for="email">Email</label>
                                <input type="email" name="email" class="form-control" placeholder="Email"
                                    value="{{ old('email') }}">
                                @error('email')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="password">Password</label>
                                <input type="password" name="password" class="form-control" placeholder="Password">
                                @error('password')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <button type="submit" class="btn btn-primary">Login</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
