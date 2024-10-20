<style>
    .highlight {
        background-color: yellow;
        color: black;
        /* optional to ensure the text is readable */
    }
</style>
@php
    // Highlight search value in blog title
    function highlight($text, $searchValue)
    {
        if (!$searchValue) {
            return $text;
        }
        // Escape any special characters in the search value to avoid issues
        $escapedSearchValue = htmlspecialchars($searchValue, ENT_QUOTES);
        // Wrap the search value with a span for highlighting
        return str_ireplace($escapedSearchValue, "<span class='highlight'>$escapedSearchValue</span>", $text);
    }
@endphp

@extends('blog.layouts.main')
@section('content')
    <div class="row">
        <div class="col-12">
            <div class="breadcrumbs mb-4"> <a href="{{ route('front.home') }}">Home</a>
                <span class="mx-1">/</span> <a style="cursor: default">Search</a>
                {{-- <span class="mx-1">/</span> <a>{{ $categoryWithBlogs->name }}</a> --}}
            </div>
            <h3 class="mb-4 border-bottom border-primary d-inline">{{ $blogs->count() }} Search results for:</h3>
            <p class="d-inline"><b>"{{ $searchValue }}"</b></p>
        </div>
        <div class="col-lg-8 mb-5 mb-lg-0">
            <div class="row">
                @forelse ($blogs as $blog)
                <div class="col-md-6 mb-4">
                        <article class="card article-card article-card-sm h-100">
                            <a href="{{ route('front.blog.details', ['id' => $blog->id, 'slug' => $blog->slug]) }}">
                                <div class="card-image">
                                    <div class="post-info"> <span
                                            class="text-uppercase">{{ $blog->created_at->diffForHumans() }}</span>
                                        <span class="text-uppercase">{{ $blog->views }} Views</span>
                                    </div>
                                    <img loading="lazy" decoding="async" src="{{ asset($blog->image) }}"
                                        alt="Post Thumbnail" class="w-100" width="420" height="280">
                                </div>
                            </a>
                            <div class="card-body px-0 pb-0">
                                <ul class="post-meta mb-2">
                                    <li>
                                        <a
                                            href="{{ route('front.blog.categoryWiseBlogs', $blog->category->slug) }}">{{ $blog->category->name }}</a>
                                    </li>
                                </ul>
                                {{-- mark down title with yellow --}}



                                <h2>
                                    <a class="post-title"
                                        href="{{ route('front.blog.details', ['id' => $blog->id, 'slug' => $blog->slug]) }}">
                                        {!! highlight($blog->title, $searchValue) !!}
                                    </a>
                                </h2>

                                {{-- <p class="card-text">Heading Here is example of hedings. You can use this
                            heading by following markdownify rules. For example: use # for …</p> --}}
                                <div class="content"> <a class="read-more-btn"
                                        href="{{ route('front.blog.details', ['id' => $blog->id, 'slug' => $blog->slug]) }}">Read
                                        Full
                                        Article</a>
                                </div>
                            </div>
                        </article>
                    </div>
                @empty
                    <div class="col-12">
                        <hr>
                        <h3 class="text-center">No search results found</h3>
                    </div>
                @endforelse

            </div>
        </div>

        @include('blog.component.widgets')
    </div>
@endsection
