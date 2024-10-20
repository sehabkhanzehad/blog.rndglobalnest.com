@php
    $categories = \App\Models\BlogCategory::with([
        'blogs' => function ($query) {
            $query->select('id', 'blog_category_id', 'title', 'status')->where('status', 1);
        },
    ])
        ->where('status', 1)
        ->orderBy('name', 'asc')
        ->get(['id', 'name', 'slug', 'status']);

    $custom_pages = DB::table('custom_pages')->where('status', 1)->get();
@endphp

<!DOCTYPE html>
<html lang="en-us">

<head>
    <meta charset="utf-8">
    <title>Reporter - HTML Blog Template</title>
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=5">
    <meta name="description" content="This is meta description">
    <meta name="author" content="Themefisher">
    <link rel="shortcut icon" href="{{ asset('blog') }}/images/favicon.png" type="image/x-icon">
    <link rel="icon" href="{{ asset('blog') }}/images/favicon.png" type="{{ asset('blog') }}/image/x-icon">

    <!-- theme meta -->
    <meta name="theme-name" content="reporter" />

    <!-- # Bangla Web Font -->
    <link href="https://fonts.maateen.me/adorsho-lipi/font.css" rel="stylesheet">

    <style>
        body {
            font-family: 'AdorshoLipi', Arial, sans-serif !important;
        }
    </style>
    <!-- # Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Neuton:wght@700&family=Work+Sans:wght@400;500;600;700&display=swap"
        rel="stylesheet">

    <!-- # CSS Plugins -->
    <link rel="stylesheet" href="{{ asset('blog') }}/plugins/bootstrap/bootstrap.min.css">

    <!-- # Main Style Sheet -->
    <link rel="stylesheet" href="{{ asset('blog') }}/css/style.css">
</head>

<body>

    <header class="navigation">
        <div class="container">
            <nav class="navbar navbar-expand-lg navbar-light px-0">
                <a class="navbar-brand order-1 py-0" href="{{ route('front.home') }}">
                    <img loading="prelaod" decoding="async" class="img-fluid" src="{{ asset(siteInfo()->logo) }}"
                        alt="Reporter Hugo">
                </a>
                <div class="navbar-actions order-3 ml-0 ml-md-4">
                    <button aria-label="navbar toggler" class="navbar-toggler border-0" type="button"
                        data-toggle="collapse" data-target="#navigation"> <span class="navbar-toggler-icon"></span>
                    </button>
                </div>
                <form action="{{ route('front.search') }}" class="search order-lg-3 order-md-2 order-3 ml-auto">
                    <input id="search-query" name="search" type="search" placeholder="Search..." autocomplete="off">
                </form>
                <div class="collapse navbar-collapse text-center order-lg-2 order-4" id="navigation">
                    <ul class="navbar-nav mx-auto mt-3 mt-lg-0">
                        <li class="nav-item"> <a class="nav-link"
                                href="{{ route('front.customPages', 'about-us') }}">About Us</a>
                        </li>
                        <li class="nav-item dropdown"> <a class="nav-link dropdown-toggle" href="#" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                Articles
                            </a>
                            <div class="dropdown-menu">
                                @foreach ($categories as $category)
                                    @if ($category->blogs->count() > 0)
                                        <a class="dropdown-item"
                                            href="{{ route('front.blog.categoryWiseBlogs', $category->slug) }}">{{ $category->name }}({{ $category->blogs->count() }})</a>
                                    @endif
                                @endforeach
                            </div>
                        </li>
                        <li class="nav-item"> <a class="nav-link" href="{{ route('front.contact') }}">Contact</a>
                        </li>
                    </ul>
                </div>
            </nav>
        </div>
    </header>

    <main>
        <section class="section">
            <div class="container">
                @yield('content')

            </div>
        </section>
    </main>

    <footer class="bg-dark mt-5">
        <div class="container section">
            <div class="row">
                <div class="col-lg-10 mx-auto text-center">
                    <a class="d-inline-block mb-4 pb-2" href="{{ route('front.home') }}">
                        <img loading="prelaod" decoding="async" class="img-fluid bg-white"
                            style="border-radius: 0px 8px 0px 8px;" src="{{ asset(siteInfo()->logo) }}"
                            alt="Reporter Hugo">
                    </a>
                    <ul class="p-0 d-flex navbar-footer mb-0 list-unstyled">
                        @foreach ($custom_pages as $pages)
                            <li class="nav-item my-0"> <a class="nav-link"
                                    href="{{ route('front.customPages', $pages->slug) }}">{{ $pages->page_name }}</a>
                            </li>
                        @endforeach

                    </ul>
                </div>
            </div>
        </div>
        <div class="copyright bg-dark content">Developed By <a target="_blank" href="https://rndglobalnest.com/">RND
                Global Nest</a></div>
    </footer>


    <!-- # JS Plugins -->
    <script src="{{ asset('blog') }}/plugins/jquery/jquery.min.js"></script>
    <script src="{{ asset('blog') }}/plugins/bootstrap/bootstrap.min.js"></script>

    <!-- Main Script -->
    <script src="{{ asset('blog') }}/js/script.js"></script>

</body>

</html>
