@extends('blog.layouts.main')
@section('content')
    <div class="row">
        <div class="col-lg-8 mx-auto">
            <div class="breadcrumbs mb-4"> <a href="{{ route('front.home') }}">Home</a>
                <span class="mx-1">/</span> <a href="{{ route('front.customPages', $customPage->slug) }}">{{ $customPage->page_name
                 }}</a>
            </div>
        </div>
        <div class="col-lg-8 mx-auto mb-5 mb-lg-0">
            <h1 class="mb-4">{{ $customPage->page_name }}</h1>
            <div class="content">
               {!! $customPage->description !!}
            </div>
        </div>
    </div>
@endsection
