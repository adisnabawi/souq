<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Ads;
use App\Models\Image;
use Auth;

class IndexController extends Controller
{
    public function index()
    {
        $cats = Category::get();
        $products = Ads::with('image','status')->whereNotIn('stat_id', [4])->limit(8)->latest()->get();
        return view('welcome', compact('cats', 'products'));
    }

    public function dashboard()
    {
        $products = Ads::with('image', 'category','status')->where('user_id', Auth()->user()->id)->latest()->paginate(3);
        return view('dashboard', compact('products'));
    }
}
