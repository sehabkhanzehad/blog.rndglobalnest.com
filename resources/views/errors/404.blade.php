@extends('blog.layouts.main')
@section('content')
    <div class="row">
        <div class="col-lg-10 mx-auto text-center">
            <img loading="lazy" decoding="async" src="{{ asset("blog") }}/images/404.png" alt="404" class="img-fluid mb-4" width="500"
                height="350">
            <h1 class="mb-4">Page Not Found!</h1>
            <a href="{{ route('front.home') }}" class="btn btn-outline-primary">Back To Home</a>
        </div>
    </div>
@endsection
