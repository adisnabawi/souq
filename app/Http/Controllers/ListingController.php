<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Subs;
use App\Models\Ads;
use App\Models\Image;
use App\Models\Location;
use App\Models\Status;
use App\Models\Likes;
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
        $ads = Ads::with('image', 'category', 'subcategory', 'poster', 'location', 'status')->whereNotIn('stat_id', [4]);
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

        $ads->orderBy('stat_id', 'ASC');
        if(isset($request->sort)){
           switch($request->sort){
                case "pricelowtohigh":
                    $ads->orderBy('ad_price', 'ASC');
                    break;
                case "pricehightolow":
                    $ads->orderBy('ad_price', 'DESC');
                    break;
                case "oldest":
                    $ads->orderBy('created_at', 'ASC');
                    break;
                default:
                    $ads->orderBy('created_at', 'DESC');
                    break;
           }
        }else{
            $ads->latest();
        }

        $ads = $ads->paginate(12);
        return view('listing', compact('ads', 'categories', 'subcategories', 'catname', 'locations', 'locname'));
    }

    public function product(Request $request)
    {
        $product = Ads::with('image', 'category', 'subcategory', 'poster', 'location', 'status', 'likes')->where('ad_id', $request->id)
                 ->whereNotIn('stat_id', [4])->first();
        if($product){
            $others = Ads::with('image','category')->where('stat_id', [1])->where('cat_id', $product->cat_id)
                      ->whereNotIn('ad_id', [$product->ad_id])->inRandomOrder()->limit(4)->get();
            return view('product', compact('product', 'others'));
        }else {
            abort(404);
        }
        
    }

    public function mylikes(Request $request)
    {
        $ads = Likes::with('ads', 'ads.image')->where('user_id', Auth()->user()->id)->paginate(12);
        return view('mylike', compact('ads'));
    }
}
