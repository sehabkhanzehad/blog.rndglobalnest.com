<?php

namespace App\Http\Controllers\WEB\Admin;

use App\Http\Controllers\Controller;
use App\Models\Blog;
use App\Models\BlogCategory;
use App\Models\Setting;
use Carbon\Carbon;


class DashboardController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function dashobard()
    {
        if (!auth()->user()->can('admin.dashboard')) {
            return redirect()->route('admin.login');
            // abort(403, 'Unauthorized action.');
        }
        $setting = Setting::first();

        return view('admin.dashboard')->with([
            'setting' => $setting,
            'categories' => BlogCategory::where('status', 1)->get(),
            'totalBlog' => Blog::where('status', operator: 1)->get(),
            // today blog
            'todayBlogs' => Blog::where('status', 1)
                ->whereDate('created_at', Carbon::today())
                ->get(),


        ]);
    }
}
