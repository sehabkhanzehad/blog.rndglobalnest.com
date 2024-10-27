@php
    $categories = \App\Models\BlogCategory::with([
        'blogs' => function ($query) {
            $query->select('id', 'blog_category_id', 'title', 'status')->where('status', 1);
        },
    ])
        ->where('status', 1)
        ->orderBy('name', 'asc')
        ->get(['id', 'name', 'slug', 'status']);

@endphp
@extends('blog.layouts.main')
@section('content')
    <div class="row no-gutters-lg">
        <div class="col-12">
            <h2 class="section-title">Latest Articles</h2>
        </div>
        <div class="col-lg-8 mb-5 mb-lg-0">
            <div class="row">
                <div class="col-12 mb-4">
                    <article class="card article-card">
                        <a
                            href="{{ route('front.blog.details', ['id' => $latestFirstBlog->id, 'slug' => $latestFirstBlog->slug]) }}">
                            <div class="card-image">
                                <div class="post-info"> <span
                                        class="text-uppercase">{{ $latestFirstBlog->created_at->diffForHumans() }}</span>
                                    <span class="text-uppercase">{{ $latestFirstBlog->views }} Views</span>
                                </div>
                                <img loading="lazy" decoding="async" src="{{ asset($latestFirstBlog->image) }}"
                                    alt="Post Thumbnail" class="w-100">
                            </div>
                        </a>
                        @php
                            $author = \App\Models\User::where('id', $latestFirstBlog->admin_id)->first();
                        @endphp
                        <div class="card-body px-0 pb-1">
                            <ul class="post-meta mb-2 d-flex justify-content-between">
                                <li>
                                    <a style="cursor: default">{{ $author->name }}</a>
                                </li>
                                <li>
                                    <a
                                        href="{{ route('front.blog.categoryWiseBlogs', $latestFirstBlog->category->slug) }}">{{ $latestFirstBlog->category->name }}</a>
                                </li>
                            </ul>
                            <h2 class="h1"><a class="post-title"
                                    href="{{ route('front.blog.details', ['id' => $latestFirstBlog->id, 'slug' => $latestFirstBlog->slug]) }}">{{ $latestFirstBlog->title }}</a>
                            </h2>
                            {{-- <p class="card-text">Heading Here is example of hedings. You can use this
                                heading by following markdownify rules. For example: use # for heading 1 and
                                use ###### for heading 6.</p> --}}
                            <div class="content"> <a class="read-more-btn"
                                    href="{{ route('front.blog.details', ['id' => $latestFirstBlog->id, 'slug' => $latestFirstBlog->slug]) }}">Read
                                    Full
                                    Article</a>
                            </div>
                        </div>
                    </article>
                </div>
                @foreach ($latestBlogs as $blog)
                    @if ($loop->first)
                        @continue
                    @endif
                    <div class="col-md-6 mb-4">
                        <article class="card article-card article-card-sm h-100">
                            <a href="{{ route('front.blog.details', ['id' => $blog->id, 'slug' => $blog->slug]) }}">
                                <div class="card-image">
                                    <div class="post-info"> <span
                                            class="text-uppercase">{{ $blog->created_at->diffForHumans() }}</span>
                                        <span class="text-uppercase">{{ $blog->views }} Views</span>
                                    </div>
                                    <img loading="lazy" decoding="async" src="{{ asset($blog->image) }}"
                                        alt="Post Thumbnail" class="w-100">
                                </div>
                            </a>
                            @php
                                $authorX = \App\Models\User::where('id', $blog->admin_id)->first();
                            @endphp
                            <div class="card-body px-0 pb-0">
                                <ul class="post-meta mb-2 d-flex justify-content-between">
                                    <li><a style="cursor: default">{{ $authorX->name }}</a>
                                    </li>
                                    <li> <a
                                            href="{{ route('front.blog.categoryWiseBlogs', $blog->category->slug) }}">{{ $blog->category->name }}</a>
                                    </li>
                                </ul>
                                <h2><a class="post-title"
                                        href="{{ route('front.blog.details', ['id' => $blog->id, 'slug' => $blog->slug]) }}">{{ $blog->title }}</a>
                                </h2>
                                {{-- <p class="card-text">Lorem ipsum dolor sit amet, consectetur adipiscing elit,
                                    sed do eiusmod tempor incididunt ut labore et dolore magna …</p> --}}
                                <div class="content"> <a class="read-more-btn"
                                        href="{{ route('front.blog.details', ['id' => $blog->id, 'slug' => $blog->slug]) }}">Read
                                        Full
                                        Article</a>
                                </div>
                            </div>
                        </article>
                    </div>
                @endforeach
                <div class="col-12">
                    <div class="row">
                        <div class="col-12">
                            <nav class="mt-4">
                                <!-- pagination -->
                                <nav class="mb-md-50">
                                    <ul class="pagination justify-content-center">
                                        {{ $latestBlogs->links() }}
                                    </ul>
                                </nav>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        @include('blog.component.widgets')
    </div>
@endsection
