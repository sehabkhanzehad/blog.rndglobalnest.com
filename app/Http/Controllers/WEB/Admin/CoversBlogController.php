<?php

namespace App\Http\Controllers\WEB\Admin;

use App\Http\Controllers\Controller;
use App\Models\Blog;
use App\Models\PopularPost;
use App\Models\CoverBlog;
use Illuminate\Http\Request;

class CoversBlogController extends Controller
{


    public function index()
    {
        $blogs = Blog::with('category', 'comments')->where('status', 1)->get();
        $covers = CoverBlog::with('blog')->orderBy('is_cover', 'ASC')->get();

        return view('admin.covers_blog', compact('covers', 'blogs'));
    }

    public function store(Request $request)
    {
        $rules = [
            'is_cover' => 'required',
            'blog_id' => 'required|unique:cover_blogs',

        ];
        $customMessages = [
            'blog_id.required' => trans('admin_validation.Blog is required'),
            'blog_id.unique' => trans('admin_validation.Blog already exist'),
        ];
        $this->validate($request, $rules, $customMessages);

        $check = CoverBlog::where('is_cover', $request->is_cover)->first();
        if($check){
            $check->delete();
        }

        $coverBlog = new CoverBlog();
        $coverBlog->blog_id = $request->blog_id;
        $coverBlog->is_cover = $request->is_cover;
        $coverBlog->save();

        $notification = trans('admin_validation.Added Successfully');
        $notification = array('messege' => $notification, 'alert-type' => 'success');
        return redirect()->back()->with($notification);
    }

    // public function destroy($id)
    // {
    //     $blog = PopularPost::find($id);
    //     $blog->delete();

    //     $notification = trans('admin_validation.Delete Successfully');
    //     $notification = array('messege' => $notification, 'alert-type' => 'success');
    //     return redirect()->back()->with($notification);
    // }

    // public function changeStatus($id)
    // {
    //     $blog = PopularPost::find($id);
    //     if ($blog->status == 1) {
    //         $blog->status = 0;
    //         $blog->save();
    //         $message = trans('admin_validation.Inactive Successfully');
    //     } else {
    //         $blog->status = 1;
    //         $blog->save();
    //         $message = trans('admin_validation.Active Successfully');
    //     }
    //     return response()->json($message);
    // }
}
