@extends("blog.layouts.main")
@section("content")
<div class="row">
    <div class="col-12">
        <div class="breadcrumbs mb-4"> <a href="{{ route("front.home") }}">Home</a>
            <span class="mx-1">/</span> <a style="cursor: default">Articles</a>
            <span class="mx-1">/</span> <a>{{ $categoryWithBlogs->name }}</a>
        </div>
        <h1 class="mb-4 border-bottom border-primary d-inline-block">{{ $categoryWithBlogs->name }}</h1>
    </div>
    <div class="col-lg-8 mb-5 mb-lg-0">
        <div class="row">
            @forelse ($categoryWithBlogs->blogs as $blog)
            <div class="col-md-6 mb-4">
                <article class="card article-card article-card-sm h-100">
                    <a href="{{ route('front.blog.details', ['category' => $blog->category->slug, 'id' => $blog->id]) }}">
                        <div class="card-image">
                            <div class="post-info"> <span class="text-uppercase">{{ $blog->created_at->diffForHumans() }}</span>
                                <span class="text-uppercase">{{ $blog->views }} Views</span>
                            </div>
                            <img loading="lazy" decoding="async" src="{{ asset($blog->image) }}" alt="Post Thumbnail"
                                class="w-100" width="420" height="280">
                        </div>
                    </a>
                    <div class="card-body px-0 pb-0">
                        <ul class="post-meta mb-2">
                            <li>
                                <a href="{{ route("front.blog.categoryWiseBlogs", $blog->category->slug) }}">{{ $categoryWithBlogs->name }}</a>
                            </li>
                        </ul>
                        <h2><a class="post-title" href="{{ route('front.blog.details', ['category' => $blog->category->slug, 'id' => $blog->id]) }}">{{ $blog->title }}</a></h2>
                        {{-- <p class="card-text">Heading Here is example of hedings. You can use this
                            heading by following markdownify rules. For example: use # for …</p> --}}
                        <div class="content"> <a class="read-more-btn" href="{{ route('front.blog.details', ['category' => $blog->category->slug, 'id' => $blog->id]) }}">Read Full
                                Article</a>
                        </div>
                    </div>
                </article>
            </div>
            @empty

            @endforelse

        </div>
    </div>
    @include("blog.component.widgets")
</div>
@endsection
