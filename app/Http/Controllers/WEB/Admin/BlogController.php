<?php

namespace App\Http\Controllers\WEB\Admin;

use App\Http\Controllers\Controller;
use App\Models\Blog;
use App\Models\BlogCategory;
use App\Models\BlogComment;
use App\Models\PopularPost;
use App\Models\Setting;
use Illuminate\Http\Request;
use  Image;
use File;
// use Auth;
use Illuminate\Support\Facades\Auth;

class BlogController extends Controller
{

    public function index()
    {
        $covers = Blog::with('category', 'comments')
            ->where('status', 1)
            // where show_homepage equal to not null
            ->whereNotNull('show_homepage')
            ->orderBy('show_homepage', 'ASC')
            ->get();


        // $blogs = Blog::with('category', 'comments')->whereNull('show_homepage')->latest()->get();
        $blogs = Blog::with('category', 'comments')->where('status', 1)->latest()->get();
        // $setting = Setting::first();
        // $frontend_url = $setting->frontend_url;
        // $frontend_view = $frontend_url . 'blogs/blog?slug=';

        return view('admin.blog', compact('blogs', 'covers'));
    }


    public function create()
    {
        $categories = BlogCategory::where('status', 1)->get();
        return view('admin.create_blog', compact('categories'));
    }


    public function store(Request $request)
    {

        // return $request->all();
        // die();
        $rules = [
            'title' => 'required|unique:blogs',
            // 'slug' => 'required|unique:blogs',
            'image' => 'required',
            'description' => 'required',
            'category' => 'required',
            // 'status' => 'required',
            // 'show_homepage' => 'required',
        ];
        $customMessages = [
            'title.required' => trans('admin_validation.Title is required'),
            // 'title.unique' => trans('admin_validation.Title already exist'),
            // 'slug.required' => trans('admin_validation.Slug is required'),
            // 'slug.unique' => trans('admin_validation.Slug already exist'),
            'image.required' => trans('admin_validation.Image is required'),
            // 'image.dimensions' => trans('admin_validation.Image width must be 900px and height must be 600px'),
            'description.required' => trans('admin_validation.Description is required'),
            'category.required' => trans('admin_validation.Category is required'),
            // 'show_homepage.required' => trans('admin_validation.Show homepage is required'),
        ];
        $this->validate($request, $rules, $customMessages);

        $admin = Auth::guard('admin')->user();
        $blog = new Blog();
        if ($request->image) {
            $image = Image::make($request->image);
            $extention = $request->image->getClientOriginalExtension();
            $image_name = 'blog-' . date('-Y-m-d-h-i-s-') . rand(999, 9999) . '.' . $extention;
            $image_name = 'uploads/custom-images/' . $image_name;
            $image->resize(900, 600);
            $image->save(public_path() . '/' . $image_name);
            $blog->image = $image_name;
        }
        if ($request->show_homepage == 'cover1') {
            $check = Blog::where('show_homepage', 'cover1')->first();
            if ($check) {
                $check->show_homepage = null;
                $check->save();
                $blog->show_homepage = 'cover1';
            } else {
                $blog->show_homepage = 'cover1';
            }
        } else if ($request->show_homepage == 'cover2') {
            $check = Blog::where('show_homepage', 'cover2')->first();
            if ($check) {
                $check->show_homepage = null;
                $check->save();
                $blog->show_homepage = 'cover2';
            } else {
                $blog->show_homepage = 'cover2';
            }
        } else if ($request->show_homepage == 'cover3') {
            $check = Blog::where('show_homepage', 'cover3')->first();
            if ($check) {
                $check->show_homepage = null;
                $check->save();
                $blog->show_homepage = 'cover3';
            } else {
                $blog->show_homepage = 'cover3';
            }
        } else if ($request->show_homepage == 'cover4') {
            $check = Blog::where('show_homepage', 'cover4')->first();
            if ($check) {
                $check->show_homepage = null;
                $check->save();
                $blog->show_homepage = 'cover4';
            } else {
                $blog->show_homepage = 'cover4';
            }
        } else {
            $blog->show_homepage = null;
        }

        // $blog->admin_id = $admin->id;
        $blog->admin_id = Auth()->user()->id;
        $blog->title = $request->title;
        $blog->description = $request->description;
        $blog->blog_category_id = $request->category;
        $blog->status = $request->status;
        // $blog->show_homepage = $request->show_homepage;
        $blog->seo_title = $request->seo_title ? $request->seo_title : $request->title;
        $blog->seo_description = $request->seo_description ? $request->seo_description : $request->title;
        $blog->date_time = $request->date_time;

        $blog->save();

        $notification = trans('admin_validation.Created Successfully');
        $notification = array('messege' => $notification, 'alert-type' => 'success');
        return redirect()->back()->with($notification);
    }

    public function edit($id)
    {
        $categories = BlogCategory::where('status', 1)->get();
        $blog = Blog::find($id);
        return view('admin.edit_blog', compact('categories', 'blog'));
    }


    public function show($id)
    {
        $blog = Blog::with('category', 'comments')->find($id);
        return response()->json(['blog' => $blog], 200);
    }


    public function update(Request $request, $id)
    {
        $blog = Blog::find($id);
        $rules = [
            'title' => 'required|unique:blogs,title,' . $blog->id,
            // 'slug' => 'required|unique:blogs,slug,' . $blog->id,
            'description' => 'required',
            'category' => 'required',
            // 'status' => 'required',
            // 'show_homepage' => 'required',
        ];
        $customMessages = [
            'title.required' => trans('admin_validation.Title is required'),
            // 'title.unique' => trans('admin_validation.Title already exist'),
            // 'slug.required' => trans('admin_validation.Slug is required'),
            // 'slug.unique' => trans('admin_validation.Slug already exist'),
            'description.required' => trans('admin_validation.Description is required'),
            'category.required' => trans('admin_validation.Category is required'),
            // 'show_homepage.required' => trans('admin_validation.Show homepage is required'),
        ];
        $this->validate($request, $rules, $customMessages);

        if($blog->show_homepage != null){
            $notification = "This blog is already in cover.";
            $notification = array('messege' => $notification, 'alert-type' => 'error');
            return redirect()->route('admin.blog.index')->with($notification);
        }

        if ($request->image) {
            $image = Image::make($request->image);
            $old_image = $blog->image;
            $extention = $request->image->getClientOriginalExtension();
            $image_name = 'blog-' . date('-Y-m-d-h-i-s-') . rand(999, 9999) . '.' . $extention;
            $image_name = 'uploads/custom-images/' . $image_name;
            $image->resize(900, 600);
            $image->save(public_path() . '/' . $image_name);
            $blog->image = $image_name;
            $blog->save();
            if ($old_image) {
                if (File::exists(public_path() . '/' . $old_image)) unlink(public_path() . '/' . $old_image);
            }
        }

        if ($request->show_homepage == 'cover1') {
            $check = Blog::where('show_homepage', 'cover1')->first();
            if ($check) {
                $check->show_homepage = null;
                $check->save();
                $blog->show_homepage = 'cover1';
            } else {
                $blog->show_homepage = 'cover1';
            }
        } else if ($request->show_homepage == 'cover2') {
            $check = Blog::where('show_homepage', 'cover2')->first();
            if ($check) {
                $check->show_homepage = null;
                $check->save();
                $blog->show_homepage = 'cover2';
            } else {
                $blog->show_homepage = 'cover2';
            }
        } else if ($request->show_homepage == 'cover3') {
            $check = Blog::where('show_homepage', 'cover3')->first();
            if ($check) {
                $check->show_homepage = null;
                $check->save();
                $blog->show_homepage = 'cover3';
            } else {
                $blog->show_homepage = 'cover3';
            }
        } else if ($request->show_homepage == 'cover4') {
            $check = Blog::where('show_homepage', 'cover4')->first();
            if ($check) {
                $check->show_homepage = null;
                $check->save();
                $blog->show_homepage = 'cover4';
            } else {
                $blog->show_homepage = 'cover4';
            }
        } else {
            $blog->show_homepage = null;
        }


        $blog->title = $request->title;
        // $blog->slug = $request->slug;
        $blog->description = $request->description;
        $blog->blog_category_id = $request->category;
        $blog->status = $request->status;
        // $blog->show_homepage = $request->show_homepage;
        $blog->seo_title = $request->seo_title ? $request->seo_title : $request->title;
        $blog->seo_description = $request->seo_description ? $request->seo_description : $request->title;
        $blog->date_time = $request->date_time;
        $blog->save();

        $notification = trans('admin_validation.Updated Successfully');
        $notification = array('messege' => $notification, 'alert-type' => 'success');
        return redirect()->route('admin.blog.index')->with($notification);
    }

    public function destroy($id)
    {
        $blog = Blog::find($id);
        $old_image = $blog->image;
        $blog->delete();
        if ($old_image) {
            if (File::exists(public_path() . '/' . $old_image)) unlink(public_path() . '/' . $old_image);
        }

        BlogComment::where('blog_id', $id)->delete();
        PopularPost::where('blog_id', $id)->delete();

        $notification =  trans('admin_validation.Delete Successfully');
        $notification = array('messege' => $notification, 'alert-type' => 'success');
        return redirect()->back()->with($notification);
    }

    public function changeStatus($id)
    {
        $blog = Blog::find($id);
        if ($blog->status == 1) {
            $blog->status = 0;
            $blog->save();
            $message = trans('admin_validation.Inactive Successfully');
        } else {
            $blog->status = 1;
            $blog->save();
            $message = trans('admin_validation.Active Successfully');
        }
        return response()->json($message);
    }
}
