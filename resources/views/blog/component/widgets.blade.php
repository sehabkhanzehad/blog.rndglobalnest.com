@php
    $categories = \App\Models\BlogCategory::with([
        'blogs' => function ($query) {
            $query->select('id', 'blog_category_id', 'title', 'status')->where('status', 1);
        },
    ])
        ->where('status', 1)
        ->orderBy('name', 'asc')
        ->get(['id', 'name', 'slug', 'status']);

    $recommendedBlogs = \App\Models\PopularPost::with('blog')->where('status', 1)->take(12)->get();

    $popularFirstBlog = \App\Models\Blog::with('category', 'comments')
        ->where('status', 1)
        ->orderBy('views', 'desc')
        ->first();
    $popularBlogs = \App\Models\Blog::with('category', 'comments')
        ->where('status', 1)
        ->orderBy('views', 'desc')
        ->take(5)
        ->get();
@endphp
<div class="col-lg-4">
    <div class="widget-blocks">
        <div class="row">
            {{-- <div class="col-lg-12">
                <div class="widget">
                    <div class="widget-body">
                        <img loading="lazy" decoding="async" src="{{ asset('blog') }}/images/author.jpg" alt="About Me"
                            class="w-100 author-thumb-sm d-block">
                        <h2 class="widget-title my-3">Hootan Safiyari</h2>
                        <p class="mb-3 pb-2">Hello, I’m Hootan Safiyari. A Content writter,
                            Developer and Story teller. Working as a Content writter at CoolTech
                            Agency. Quam nihil …</p> <a href="about.html" class="btn btn-sm btn-outline-primary">Know
                            More</a>
                    </div>
                </div>
            </div> --}}

            @if ($recommendedBlogs->count() > 0)
                <div class="col-lg-12 col-md-6">
                    <div class="widget">
                        <h2 class="section-title mb-3">Recommended</h2>
                        <div class="widget-body">
                            <div class="widget-list">
                                <article class="card mb-4">
                                    <a
                                        href="{{ route('front.blog.details', ['category' => $recommendedBlogs[0]->blog->category->slug, 'id' => $recommendedBlogs[0]->blog->id ]) }}">
                                        <div class="card-image">
                                            <div class="post-info"> <span
                                                    class="text-uppercase">{{ $recommendedBlogs[0]->blog->views }}
                                                    Views</span>
                                            </div>
                                            <img loading="lazy" decoding="async"
                                                src="{{ asset($recommendedBlogs[0]->blog->image) }}" alt="Post Thumbnail"
                                                class="w-100">
                                        </div>
                                    </a>
                                    <div class="card-body px-0 pb-1">
                                        <h3><a class="post-title post-title-sm"
                                                href="{{ route('front.blog.details', ['category' => $recommendedBlogs[0]->blog->category->slug, 'id' => $recommendedBlogs[0]->blog->id]) }}">{{ $recommendedBlogs[0]->blog->title }}</a>
                                        </h3>
                                        {{-- <p class="card-text">Lorem ipsum dolor sit amet, consectetur
                                    adipiscing elit, sed do eiusmod tempor …</p> --}}
                                        <div class="content"> <a class="read-more-btn"
                                                href="{{ route('front.blog.details', ['category' => $recommendedBlogs[0]->blog->category->slug, 'id' => $recommendedBlogs[0]->blog->id]) }}">Read
                                                Full
                                                Article</a>
                                        </div>
                                    </div>
                                </article>
                                <div class="widget-list" style="max-height: 300px; overflow-y: auto;">
                                    @foreach ($recommendedBlogs as $blog)
                                        @if ($loop->first)
                                            @continue
                                        @endif
                                        <a class="media align-items-center"
                                            href="{{ route('front.blog.details', ['category' => $blog->blog->category->slug, 'id' => $blog->blog->id]) }}">
                                            <img loading="lazy" decoding="async" src="{{ asset($blog->blog->image) }}"
                                                alt="Post Thumbnail" class="w-100">
                                            <div class="media-body ml-3">
                                                <h3 style="margin-top:-5px">{{ $blog->blog->title }}</h3>
                                                {{-- <p class="mb-0 small">Heading Here is example of hedings. You can use …</p> --}}
                                            </div>
                                        </a>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endif
            <div class="col-lg-12 col-md-6">
                <div class="widget">
                    <h2 class="section-title mb-3">Popular Articles</h2>
                    <div class="widget-body">
                        <div class="widget-list">
                            <article class="card mb-4">
                                <a
                                    href="{{ route('front.blog.details', ['category' => $popularFirstBlog->category->slug, 'id' => $popularFirstBlog->id]) }}">
                                    <div class="card-image">
                                        <div class="post-info"> <span
                                                class="text-uppercase">{{ $popularFirstBlog->views }} Views</span>
                                        </div>
                                        <img loading="lazy" decoding="async"
                                            src="{{ asset($popularFirstBlog->image) }}" alt="Post Thumbnail"
                                            class="w-100">
                                    </div>
                                </a>
                                <div class="card-body px-0 pb-1">
                                    <h3><a class="post-title post-title-sm"
                                            href="{{ route('front.blog.details', ['category' => $popularFirstBlog->category->slug, 'id' => $popularFirstBlog->id]) }}">{{ $popularFirstBlog->title }}</a>
                                    </h3>
                                    {{-- <p class="card-text">Lorem ipsum dolor sit amet, consectetur
                                        adipiscing elit, sed do eiusmod tempor …</p> --}}
                                    <div class="content"> <a class="read-more-btn"
                                            href="{{ route('front.blog.details', ['category' => $popularFirstBlog->category->slug, 'id' => $popularFirstBlog->id]) }}">Read
                                            Full
                                            Article</a>
                                    </div>
                                </div>
                            </article>
                            @foreach ($popularBlogs as $blog)
                                @if ($loop->first)
                                    @continue
                                @endif
                                <a class="media align-items-center"
                                    href="{{ route('front.blog.details', ['category' => $blog->category->slug, 'id' => $blog->id]) }}">
                                    <img loading="lazy" decoding="async" src="{{ asset($blog->image) }}"
                                        alt="Post Thumbnail" class="w-100">
                                    <div class="media-body ml-3">
                                        <h3 style="margin-top:-5px">{{ $blog->title }}</h3>
                                        {{-- <p class="mb-0 small">Heading Here is example of hedings. You
                                            can use …</p> --}}
                                    </div>
                                </a>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-12 col-md-6">
                <div class="widget">
                    <h2 class="section-title mb-3">Categories</h2>
                    <div class="widget-body" style="text-align: justify">
                        <ul class="widget-list">
                            @foreach ($categories as $category)
                                @if ($category->blogs->count() > 0)
                                    <li><a href="{{ route('front.blog.categoryWiseBlogs', $category->slug) }}">{{ $category->name }}<span
                                                class="ml-auto">({{ $category->blogs->count() }})</span></a>
                                    </li>
                                @endif
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
