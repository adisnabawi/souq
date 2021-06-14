<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Subs;
use App\Models\Ads;
use App\Models\Image;
use App\Models\Location;
use Carbon\Carbon;

class ListingController extends Controller
{
    public function index(Request $request)
    {
        $categories = Category::get();
        $subcategories = Subs::get();
        $locations = Location::get();
        $catname = null;
        $locname = null;
        $ads = Ads::with('image', 'category', 'subcategory', 'poster', 'location');
        if(isset($request->category)){
            $ads->where('cat_id', $request->category);
            $subcategories = Subs::where('cat_id', $request->category)->get();
            $catname = Category::where('cat_id', $request->category)
                       ->select('cat_name')->first();
        }

        if(isset($request->subcategory)){
            $ads->where('sub_id', $request->subcategory);
        }

        if(isset($request->location) && $request->location != 1){
            $ads->where('loc_id', $request->location);
            $locname = Location::where('loc_id', $request->location)->first();
        }

        if(isset($request->q)){
            $ads->where('ad_title', 'like', '%' . $request->q . '%');
        }

        $ads = $ads->latest()->paginate(12);
        return view('listing', compact('ads', 'categories', 'subcategories', 'catname', 'locations', 'locname'));
    }

    public function product(Request $request)
    {
        $product = Ads::with('image', 'category', 'subcategory', 'poster', 'location')->where('ad_id', $request->id)->first();
        if($product){
            return view('product', compact('product'));
        }else {
            abort(404);
        }
        
    }
}
