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

        <div class="col-lg-8 mb-5 mb-lg-0">
            <div class="row">
                <div class="col-12 mb-4">
                    @if ($cover1 != null)
                        <article class="card article-card">
                            <a
                                href="{{ route('front.blog.details', ['category' => $cover1->blog->category->slug, 'id' => $cover1->blog->id]) }}">
                                <div class="card-image">
                                    <div class="post-info"> <span
                                            class="text-uppercase">{{ date('d M Y', strtotime($cover1->blog->date_time)) }}</span>
                                        <span class="text-uppercase">{{ $cover1->blog->views }} Views</span>
                                    </div>
                                    <img loading="lazy" decoding="async" src="{{ asset($cover1->blog->image) }}"
                                        alt="Post Thumbnail" class="w-100">
                                </div>
                            </a>
                            @php
                                $author = \App\Models\User::where('id', $cover1->blog->admin_id)->first();
                            @endphp
                            <div class="card-body px-0 pb-1">
                                <ul class="post-meta mb-2 d-flex justify-content-between">
                                    <li>
                                        <a style="cursor: default">{{ $author->name }}</a>
                                    </li>
                                    <li>
                                        <a
                                            href="{{ route('front.blog.categoryWiseBlogs', $cover1->blog->category->slug) }}">{{ $cover1->blog->category->name }}</a>
                                    </li>
                                </ul>
                                <h3 class=""><a class="post-title"
                                        href="{{ route('front.blog.details', ['category' => $cover1->blog->category->slug, 'id' => $cover1->blog->id]) }}">{{ $cover1->blog->title }}</a>
                                </h3>
                                {{-- <p class="card-text">Heading Here is example of hedings. You can use this
                                heading by following markdownify rules. For example: use # for heading 1 and
                                use ###### for heading 6.</p> --}}
                                <div class="content"> <a class="read-more-btn"
                                        href="{{ route('front.blog.details', ['category' => $cover1->blog->category->slug, 'id' => $cover1->blog->id]) }}">Read
                                        Full
                                        Article</a>
                                </div>
                            </div>
                        </article>
                    @else
                        <article class="card article-card">
                            <a
                                href="{{ route('front.blog.details', ['category' => $latestFirstBlog->category->slug, 'id' => $latestFirstBlog->id]) }}">
                                <div class="card-image">
                                    <div class="post-info"> <span
                                            class="text-uppercase">{{ date('d M Y', strtotime($latestFirstBlog->date_time)) }}</span>
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
                                <h3 class=""><a class="post-title"
                                        href="{{ route('front.blog.details', ['category' => $latestFirstBlog->category->slug, 'id' => $latestFirstBlog->id]) }}">{{ $latestFirstBlog->title }}</a>
                                </h3>
                                {{-- <p class="card-text">Heading Here is example of hedings. You can use this
                                heading by following markdownify rules. For example: use # for heading 1 and
                                use ###### for heading 6.</p> --}}
                                <div class="content"> <a class="read-more-btn"
                                        href="{{ route('front.blog.details', ['category' => $latestFirstBlog->category->slug, 'id' => $latestFirstBlog->id]) }}">Read
                                        Full
                                        Article</a>
                                </div>
                            </div>
                        </article>
                    @endif
                </div>
            </div>
            <div class="row">
                <div class="col-md-4 mb-4">
                    <article class="card article-card article-card-sm h-100">
                        <a href="{{ route('front.blog.details', ['category' => $cover2->blog->category->slug, 'id' => $cover2->blog->id]) }}">
                            <div class="card-image h-100">
                                <div class="post-info"> <span
                                        class="text-uppercase">{{ date('d M Y', strtotime($cover2->blog->date_time)) }}</span>
                                    <span class="text-uppercase">{{ $cover2->blog->views }} Views</span>
                                </div>
                                <img loading="lazy" decoding="async" src="{{ asset($cover2->blog->image) }}" alt="Post Thumbnail"
                                    class="w-100">
                            </div>
                        </a>
                        @php
                            $author = \App\Models\User::where('id', $cover2->blog->admin_id)->first();
                        @endphp
                        <div class="card-body px-0 pb-0">
                            <ul class="post-meta mb-2 d-flex justify-content-between">
                                <li>
                                    <a style="cursor: default">{{ $author->name }}</a>
                                </li>
                                <li>
                                    <a
                                        href="{{ route('front.blog.categoryWiseBlogs', $cover2->blog->category->slug) }}">{{ $cover2->blog->category->name }}</a>
                                </li>
                            </ul>
                            <h4 class=""><a class="post-title"
                                    href="{{ route('front.blog.details', ['category' => $cover2->blog->category->slug, 'id' => $cover2->blog->id]) }}">{{ $cover2->blog->title }}</a>
                            </h4>
                            <div class="content"> <a class="read-more-btn"
                                    href="{{ route('front.blog.details', ['category' => $cover2->blog->category->slug, 'id' => $cover2->blog->id]) }}">Read
                                    Full
                                    Article</a>
                            </div>
                        </div>
                    </article>
                </div>
                <div class="col-md-4 mb-4">
                    <article class="card article-card article-card-sm h-100">
                        <a href="{{ route('front.blog.details', ['category' => $cover3->blog->category->slug, 'id' => $cover3->blog->id]) }}">
                            <div class="card-image h-100">
                                <div class="post-info"> <span
                                        class="text-uppercase">{{ date('d M Y', strtotime($cover3->blog->date_time)) }}</span>
                                    <span class="text-uppercase">{{ $cover3->blog->views }} Views</span>
                                </div>
                                <img loading="lazy" decoding="async" src="{{ asset($cover3->blog->image) }}" alt="Post Thumbnail"
                                    class="w-100">
                            </div>
                        </a>
                        @php
                            $author = \App\Models\User::where('id', $cover3->blog->admin_id)->first();
                        @endphp
                        <div class="card-body px-0 pb-0">
                            <ul class="post-meta mb-2 d-flex justify-content-between">
                                <li>
                                    <a style="cursor: default">{{ $author->name }}</a>
                                </li>
                                <li>
                                    <a
                                        href="{{ route('front.blog.categoryWiseBlogs', $cover3->blog->category->slug) }}">{{ $cover3->blog->category->name }}</a>
                                </li>
                            </ul>
                            <h4 class=""><a class="post-title"
                                    href="{{ route('front.blog.details', ['category' => $cover3->blog->category->slug, 'id' => $cover3->blog->id]) }}">{{ $cover3->blog->title }}</a>
                            </h4>
                            <div class="content"> <a class="read-more-btn"
                                    href="{{ route('front.blog.details', ['category' => $cover3->blog->category->slug, 'id' => $cover3->blog->id]) }}">Read
                                    Full
                                    Article</a>
                            </div>
                        </div>
                    </article>
                </div>
                <div class="col-md-4 mb-4">
                    <article class="card article-card article-card-sm h-100">
                        <a href="{{ route('front.blog.details', ['category' => $cover4->blog->category->slug, 'id' => $cover4->blog->id]) }}">
                            <div class="card-image h-100">
                                <div class="post-info"> <span
                                        class="text-uppercase">{{ date('d M Y', strtotime($cover4->blog->date_time)) }}</span>
                                    <span class="text-uppercase">{{ $cover4->blog->views }} Views</span>
                                </div>
                                <img loading="lazy" decoding="async" src="{{ asset($cover4->blog->image) }}" alt="Post Thumbnail"
                                    class="w-100">
                            </div>
                        </a>
                        @php
                            $author = \App\Models\User::where('id', $cover4->blog->admin_id)->first();
                        @endphp
                        <div class="card-body px-0 pb-0">
                            <ul class="post-meta mb-2 d-flex justify-content-between">
                                <li>
                                    <a style="cursor: default">{{ $author->name }}</a>
                                </li>
                                <li>
                                    <a
                                        href="{{ route('front.blog.categoryWiseBlogs', $cover4->blog->category->slug) }}">{{ $cover4->blog->category->name }}</a>
                                </li>
                            </ul>
                            <h4 class=""><a class="post-title"
                                    href="{{ route('front.blog.details', ['category' => $cover4->blog->category->slug, 'id' => $cover4->blog->id]) }}">{{ $cover4->blog->title }}</a>
                            </h4>
                            <div class="content"> <a class="read-more-btn"
                                    href="{{ route('front.blog.details', ['category' => $cover4->blog->category->slug, 'id' => $cover4->blog->id]) }}">Read
                                    Full
                                    Article</a>
                            </div>
                        </div>
                    </article>
                </div>
            </div>
            <div class="col-12">
                <h2 class="section-title">Latest Articles</h2>
            </div>
            <div class="row">
                @foreach ($latestBlogs as $blog)
                    <div class="col-md-6 mb-4">
                        <article class="card article-card article-card-sm h-100">
                            <a
                                href="{{ route('front.blog.details', ['category' => $blog->category->slug, 'id' => $blog->id]) }}">
                                <div class="card-image">
                                    <div class="post-info"> <span
                                            class="text-uppercase">{{ date('d M, Y', strtotime($blog->date_time)) }}</span>
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
                                <h4><a class="post-title"
                                        href="{{ route('front.blog.details', ['category' => $blog->category->slug, 'id' => $blog->id]) }}">{{ $blog->title }}</a>
                                </h4>
                                {{-- <p class="card-text">Lorem ipsum dolor sit amet, consectetur adipiscing elit,
                                    sed do eiusmod tempor incididunt ut labore et dolore magna …</p> --}}
                                <div class="content"> <a class="read-more-btn"
                                        href="{{ route('front.blog.details', ['category' => $blog->category->slug, 'id' => $blog->id]) }}">Read
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
