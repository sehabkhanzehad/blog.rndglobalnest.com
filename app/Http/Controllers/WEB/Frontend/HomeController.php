<?php

namespace App\Http\Controllers\WEB\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Blog;
use App\Models\BlogCategory;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\SubCategory;
use App\Models\Product;
use App\Models\ChildCategory;
use App\Models\CoverBlog;
use App\Models\FlashSaleProduct;
use App\Models\HomeBottomSetting;
use App\Models\CustomPage;
use App\Models\User;
use Illuminate\Support\Facades\DB;


class HomeController extends Controller
{
    public function index()
    {
        $latestBlogs = Blog::with('category', 'comments', 'admin')
            ->where('status', 1)
            ->orderBy('date_time', 'desc')
            ->paginate(30);

        $popularFirstBlog = Blog::with('category', 'comments', 'admin')
            ->where('status', 1)
            ->orderBy('views', 'desc')
            ->first();


        // return $latestBlogs;
        // die();

        return view('blog.pages.index', [
            "home_bottom_settings" => HomeBottomSetting::all(),
            "latestFirstBlog" => Blog::with('category', 'comments', 'admin')->where('status', 1)->orderBy('date_time', 'desc')->first(),
            "cover1" => CoverBlog::with('blog')
                            ->where('is_cover', 'cover1')
                            ->first(),

            "cover2" => CoverBlog::with('blog')
                            ->where('is_cover', 'cover2')
                            ->first(),

            "cover3" => CoverBlog::with('blog')
                            ->where('is_cover', 'cover3')
                            ->first(),

            "cover4" => CoverBlog::with('blog')
                            ->where('is_cover', 'cover4')
                            ->first(),



            "latestBlogs" => $latestBlogs,
            "categories" => BlogCategory::with([
                'blogs' => function ($query) {
                    $query->select('id', 'blog_category_id', 'title', 'status')
                        ->where('status', 1);
                }
            ])->where('status', 1)
                ->orderBy('name', 'asc')
                ->get(['id', 'slug', 'name', 'status']),
            "popularFirstBlog" => $popularFirstBlog,
        ]);
    }

    public function contact()
    {
        $footer = DB::table('footers')->first();
        // return $footer;
        // die();
        return view("blog.pages.contact", [
            "footer" => $footer,

        ]);
    }

    public function customPages($slug)
    {
        $customPage = CustomPage::where('slug', $slug)->first();
        return view('blog.pages.custom-page', compact('customPage'));
    }

    public function search(Request $request)
    {
        $searchValue = $request->get('search');

        $blogs = Blog::with('category')->where('status', 1)
            ->where('title', 'like', '%' . $request->get('search') . '%')
            ->orWhere('slug', 'like', '%' . $request->get('search') . '%')
            ->orWhere('description', 'like', '%' . $request->get('search') . '%')
            ->get();

        // Split search term into individual words
        // $searchWords = explode(' ', $searchValue);

        // $blogs = Blog::with('category')
        // ->where(function ($query) use ($searchWords) {
        //     foreach ($searchWords as $word) {
        //         $query->orWhere('title', 'like', '%' . $word . '%');
        //         $query->orWhere('slug', 'like', '%' . $word . '%');
        //         // $query->orWhere('description', 'like', '%' . $word . '%');
        //     }
        // })
        // ->get();

        return view('blog.pages.search', compact('searchValue', 'blogs'));
    }
}
