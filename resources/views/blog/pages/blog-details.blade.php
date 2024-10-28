@extends('blog.layouts.main')
@section('content')
    <div class="row">
        <div class="col-lg-8 mb-5 mb-lg-0">
            <article>
                <img loading="lazy" decoding="async" src="{{ asset($blog->image) }}" alt="Post Thumbnail" class="w-100">

                <ul class="post-meta mb-2 mt-4 d-flex justify-content-between">
                    <li>
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                            style="margin-right:5px;margin-top:-4px" class="text-dark" viewBox="0 0 16 16">
                            <path d="M5.5 10.5A.5.5 0 0 1 6 10h4a.5.5 0 0 1 0 1H6a.5.5 0 0 1-.5-.5z" />
                            <path
                                d="M3.5 0a.5.5 0 0 1 .5.5V1h8V.5a.5.5 0 0 1 1 0V1h1a2 2 0 0 1 2 2v11a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V3a2 2 0 0 1 2-2h1V.5a.5.5 0 0 1 .5-.5zM2 2a1 1 0 0 0-1 1v11a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1V3a1 1 0 0 0-1-1H2z" />
                            <path d="M2.5 4a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5H3a.5.5 0 0 1-.5-.5V4z" />
                        </svg> <span>{{ $blog->created_at->format('d M Y h:i A') }}</span>
                    </li>


                    {{-- <li>
                        <a style="color:black; cursor:default">{{ $blog->views }} Views</a>
                    </li> --}}

                    <li>
                        Share this:
                        {{-- here share this with social media show with icon fontawesome --}}
                        <a href="https://www.facebook.com/sharer/sharer.php?u={{ route('front.blog.details', ['category' => $blog->category->slug, 'id' => $blog->id]) }}"
                            target="_blank" class="text-dark" style="margin-right:5px">
                            <i class="fab fa-facebook-f"></i>
                        </a>

                        <a href="https://www.instagram.com/?url={{ route('front.blog.details', ['category' => $blog->category->slug, 'id' => $blog->id]) }}"
                            target="_blank" class="text-dark" style="margin-right:5px">
                            <i class="fab fa-instagram"></i>
                        </a>

                        <a href="https://twitter.com/share?url={{ route('front.blog.details', ['category' => $blog->category->slug, 'id' => $blog->id]) }}"
                            target="_blank" class="text-dark" style="margin-right:5px">
                            <i class="fab fa-twitter"></i>
                        </a>

                        <a href="https://www.linkedin.com/shareArticle?mini=true&url={{ route('front.blog.details', ['category' => $blog->category->slug, 'id' => $blog->id]) }}"
                            target="_blank" class="text-dark" style="margin-right:5px">
                            <i class="fab fa-linkedin-in"></i>
                        </a>

                        {{-- <a href="https://www.pinterest.com/pin/create/button/?url={{ route('front.blog.details', ['category' => $blog->category->slug, 'id' => $blog->id]) }}"
                            target="_blank" class="text-dark" style="margin-right:5px">
                            <i class="fab fa-pinterest-p"></i>
                        </a> --}}

                        {{-- <a href="https://www.reddit.com/submit?url={{ route('front.blog.details', ['category' => $blog->category->slug, 'id' => $blog->id]) }}"
                            target="_blank" class="text-dark" style="margin-right:5px">
                            <i class="fab fa-reddit-alien"></i>
                        </a> --}}

                        <a href="https://telegram.me/share/url?url={{ route('front.blog.details', ['category' => $blog->category->slug, 'id' => $blog->id]) }}"
                            target="_blank" class="text-dark" style="margin-right:5px">
                            <i class="fab fa-telegram-plane"></i>
                        </a>

                        <a href="https://wa.me/?text={{ route('front.blog.details', ['category' => $blog->category->slug, 'id' => $blog->id]) }}"
                            target="_blank" class="text-dark" style="margin-right:5px">
                            <i class="fab fa-whatsapp"></i>
                        </a>

                        {{-- <a href="mailto:?body={{ route('front.blog.details', ['category' => $blog->category->slug, 'id' => $blog->id]) }}"
                            target="_blank" class="text-dark" style="margin-right:5px">
                            <i class="fas fa-envelope"></i>
                        </a> --}}
                        {{-- insta share --}}



                    </li>
                </ul>
                {{-- here show writer position and auto generated image with name with third party api --}}



                <h1 class="my-0">{{ $blog->title }}</h1>
                <ul class="post-meta mb-2 mt-4 d-flex justify-content-between">
                    <li>
                        <div class="d-flex align-items-center">
                            <div class="avatar mr-3">
                                <img style="max-width: none" class="rounded-circle"
                                    src="https://ui-avatars.com/api/?name={{ \App\Models\User::find($blog->admin_id)->name }}&background=random"
                                    alt="User Avatar">
                            </div>
                            <div>
                                <h4 class="my-0">{{ \App\Models\User::find($blog->admin_id)->name }}</h4>
                                <span>{{ \App\Models\User::find($blog->admin_id)->designation }}</span>
                            </div>
                        </div>
                    </li>

                    <li>Category: <a
                            href="{{ route('front.blog.categoryWiseBlogs', $blog->category->slug) }}">{{ $blog->category->name }}</a>
                    </li>



                </ul>
                <hr>
                <div class="content text-left">
                    <p>{!! $blog->description !!}</p>
                </div>

            </article>
            <hr>
            {{-- show coments and replay and comment box button below without disqus --}}
            <div class="comments" id ="comment-id">
                {{-- show comments with  small icons avatar, name, time in one line then newline and comment  --}}
                <h3 class="text-left">Comments</h3>
                @if (session('success'))
                    <div class="alert alert-success text-center">{{ session('success') }}</div>
                @endif
                @foreach ($blog->comments as $comment)
                    <div class="comment">
                        <div class="d-flex">
                            <div class="avatar mr-3">
                                <img style="max-width: none" class="rounded-circle"
                                    src="https://ui-avatars.com/api/?name={{ $comment->name }}&background=random"
                                    alt="User Avatar">
                            </div>
                            <div class="comment-content">
                                <h4 class="">{{ $comment->name }}</h4>
                                <span>{{ $comment->created_at->diffForHumans() }}</span>
                                <p>{{ $comment->comment }}</p>
                            </div>
                        </div>
                    </div>
                @endforeach
                <div class="comment-form">
                    <h3 class="text-left">Leave a Comment</h3>

                    <form action="{{ route('front.blog.comment') }}" method="post">
                        @csrf
                        <div class="form-group">
                            <input type="text" name="name" required class="form-control" placeholder="Name">
                            <input type="hidden" name="blog_id" value="{{ $blog->id }}" id="">
                            {{-- show error message --}}
                            @error('name')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <input type="email" name="email" required class="form-control" placeholder="Email">
                            @error('email')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <textarea class="form-control" rows="5" required name="comment" placeholder="Comment"></textarea>
                            @error('comment')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
            @if ($relatedBlogs->count() > 0)
                <div class="related-post mt-5">
                    <hr>
                    <h2 class="section-title mb-3">Related Articles</h2>
                    <div class="row">
                        @foreach ($relatedBlogs as $relatedBlog)
                            <div class="col-lg-4 col-md-6 border-bottom p-3">
                                <div class="post">
                                    <a
                                        href="{{ route('front.blog.details', ['category' => $relatedBlog->category->slug, 'id' => $relatedBlog->id]) }}">
                                        <img loading="lazy" decoding="async" src="{{ asset($relatedBlog->image) }}"
                                            alt="Post Thumbnail" class="w-100">
                                    </a>
                                    <div class="post-content">
                                        <ul class="post-meta mb-2 mt-4 d-flex justify-content-between">
                                            <li>
                                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                    fill="currentColor" style="margin-right:5px;margin-top:-4px"
                                                    class="text-dark" viewBox="0 0 16 16">
                                                    <path
                                                        d="M5.5 10.5A.5.5 0 0 1 6 10h4a.5.5 0 0 1 0 1H6a.5.5 0 0 1-.5-.5z" />
                                                    <path
                                                        d="M3.5 0a.5.5 0 0 1 .5.5V1h8V.5a.5.5 0 0 1 1 0V1h1a2 2 0 0 1 2 2v11a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V3a2 2 0 0 1 2-2h1V.5a.5.5 0 0 1 .5-.5zM2 2a1 1 0 0 0-1 1v11a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1V3a1 1 0 0 0-1-1H2z" />
                                                    <path
                                                        d="M2.5 4a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5H3a.5.5 0 0 1-.5-.5V4z" />
                                                </svg> <span>{{ $relatedBlog->created_at->format('M y') }}</span>
                                            </li>
                                            <li> <a
                                                    href="{{ route('front.blog.categoryWiseBlogs', $relatedBlog->category->slug) }}">{{ $relatedBlog->category->name }}</a>
                                            </li>
                                        </ul>
                                        <h4><a
                                                href="{{ route('front.blog.details', ['category' => $relatedBlog->category->slug,'id' => $relatedBlog->id]) }}">{{ $relatedBlog->title }}</a>
                                        </h4>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            @endif








        </div>
        @include('blog.component.widgets')
    </div>
@endsection
@section('script')
    @if (session('scrollTo'))
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                const element = document.getElementById('{{ session('scrollTo') }}');
                if (element) {
                    element.scrollIntoView({
                        behavior: 'smooth'
                    });
                }
            });
        </script>
    @endif
@endsection
