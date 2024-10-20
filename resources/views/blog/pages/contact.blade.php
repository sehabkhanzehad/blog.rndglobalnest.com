@php
    // $footer = \Illuminate\Support\Facades\DB::table('footers')->first();
@endphp
@extends('blog.layouts.main')
@section('content')
    <div class="row">
        <div class="col-12">
            <div class="breadcrumbs mb-4"> <a href="{{ route('front.home') }}">Home</a>
                <span class="mx-1">/</span> <a>Contact</a>
            </div>
        </div>
        <div class="col-lg-4">
            <div class="pr-0 pr-lg-4">
                <div class="content">
                    {{-- Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor
                    incididunt ut labor. --}}

                    <div class="mt-5">
                        <p class="h3 mb-3 font-weight-normal"><a class="text-dark"
                                href="mailto:{{ $footer->email }}">{{ $footer->email }}</a>
                        </p>
                        <p class="mb-3"><a class="text-dark"
                                href="tel:{{ $footer->phone }}">{{ $footer->phone }}</a>
                        </p>
                        <p class="mb-2">{{ $footer->address }}</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-6 mt-4 mt-lg-0">
            <form method="POST" action="" class="row">
                <div class="col-md-6">
                    <input type="text" class="form-control mb-4" required placeholder="Name" name="name" id="name">
                </div>
                <div class="col-md-6">
                    <input type="email" class="form-control mb-4" required placeholder="Email" name="email" id="email">
                </div>
                <div class="col-12">
                    <input type="text" class="form-control mb-4" required placeholder="Subject" name="subject" id="subject">
                </div>
                <div class="col-12">
                    <textarea name="message" id="message" required class="form-control mb-4" placeholder="Type You Message Here" rows="5"></textarea>
                </div>
                <div class="col-12">
                    <a class="btn btn-outline-primary" type="submit">Send Message</a>
                </div>
            </form>
        </div>
    </div>
@endsection
