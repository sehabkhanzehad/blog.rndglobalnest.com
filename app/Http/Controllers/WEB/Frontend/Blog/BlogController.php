<?php

namespace App\Http\Controllers\WEB\Frontend\Blog;

use App\Http\Controllers\Controller;
use App\Models\Blog;
use App\Models\BlogCategory;
use App\Models\BlogComment;
use App\Models\PopularPost;
use Illuminate\Http\Request;

class BlogController extends Controller
{
    function blogDetails($slug, $id)
    {
        $blog = Blog::with('category', 'comments')->where('slug', $slug)->where('id', $id)->first();
        $blog->increment("views", 1);

        return view("blog.pages.blog-details", [
            "blog" => $blog,
        ]);
    }
    function categoryWiseBlogs($slug)
    {
        return view("blog.pages.blogs-category", [
            "categoryWithBlogs" => BlogCategory::with('blogs')->where('slug', $slug)->first(),
        ]);
    }
    public function commentStore(Request $request)
    {
        try {
            $blogId = $request->input('blog_id');
            $name = $request->input('name');
            $email = $request->input('email');
            $commment = $request->input('comment');

            BlogComment::create([
                'blog_id' => $blogId,
                'name' => $name,
                'email' => $email,
                'comment' => $commment
            ]);

            return response()->json([
                'status' => "success",
                'message' => 'Comment submited successfully',
            ], 200);
        } catch (\Throwable $th) {
            return response()->json([
                'status' => "failed",
                'message' => 'Something went wrong',
                'error' => $th->getMessage(),
            ], 500);
        }
    }
}
