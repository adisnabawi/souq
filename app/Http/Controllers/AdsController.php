<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\UploadedFile;
use App\Models\Category;
use App\Models\Subs;
use App\Models\Ads;
use App\Models\Image;
use App\Models\Location;
use Auth;

class AdsController extends Controller
{
    public function index()
    {
        $cats = Category::get();
        $subs = Subs::get();
        $locations = Location::get();
        return view('ads', compact('cats', 'subs', 'locations'));
    }

    public function subcategory(Request $request)
    {
        $subs = Subs::where('cat_id', $request->id)->get();
        return response()->json($subs);
    }

    public function create(Request $request)
    {
        $request->validate([
            'title' => 'required|max:200',
            'description' => 'required',
            'category' => 'required',
            'price' => 'required|regex:/^[0-9]+(\.[0-9][0-9]?)?$/',
        ]);

        $ad = new Ads;
        $ad->ad_title = $request->title;
        $ad->ad_description = $request->description;  
        $ad->ad_price = $request->price;
        $ad->cat_id = $request->category;
        $ad->sub_id = $request->subcategory;
        $ad->loc_id = $request->location;
        $ad->user_id = Auth()->user()->id;
        $ad->save();
        if($ad) {
            $adid = $ad->ad_id;
            return redirect()->route('ads.image', ['id' => $adid])->with('status', 'Success created your ads');
        }else {
            return redirect()->back();
        }
    }

    public function image(Request $request)
    {
        $ad = Ads::where('ad_id', $request->id)->where('user_id', Auth()->user()->id)->first();
        $adid = $ad->ad_id;
        if($ad) {
            $imgs = Image::where('ad_id', $ad->ad_id)->get();
            return view('ads-image', compact('ad','imgs', 'adid'));
        }else {
            abort(404);
        }
        
    }

    public function upload(Request $request)
    {
        $ad = Ads::where('ad_id', $request->id)->where('user_id', Auth()->user()->id)->first();
        if($ad){
            $request->validate([
                'image' => 'required|mimes:jpeg,jpg,png'
            ]);
            
            $path = $request->file('image')->store('public');
            if ($request->file('image')->isValid()) {
                if (Storage::exists($path)){
                    $ad = new Image;
                    $ad->im_url = trim($path, 'public/');
                    $ad->ad_id = $request->id;  
                    $ad->user_id = Auth()->user()->id;
                    $ad->save();
                    return redirect()->back()->with('status', 'Success uploads');
                }else {
                    Storage::delete('public/' . trim($path, 'public/'));
                    return redirect()->back()->withErrors(['FAILED TO UPLOAD']);
                }
                
            }else {
                return redirect()->back()->withErrors(['FAILED TO UPLOAD']);
            }
        }else {
            abort(404);
        }
        
    }

    public function deleteimage(Request $request)
    {
        $image = Image::where('im_id', $request->id)->where('user_id', Auth()->user()->id)->first();
        $imageURL = $image->im_url;
        $image->delete();
        if($image){
            $success = Storage::delete('public/' . $imageURL);
            if($success) {
                return redirect()->back()->with('status', 'Success delete picture');
            }else {
                return redirect()->back();
            }
            
        }else {
            abort(404);
        }
        
    }

    public function edit(Request $request)
    {
        $ad = Ads::where('ad_id', $request->id)->where('user_id', Auth()->user()->id)->first();
        if($ad){
            $cats = Category::get();
            $locations = Location::get();
            return view('ads-edit', compact('ad', 'cats', 'locations'));
        }else{
            abort(404);
        }
    }

    public function update(Request $request)
    {
        $request->validate([
            'title' => 'required|max:200',
            'description' => 'required',
            'category' => 'required',
            'status' => 'required|boolean',
            'price' => 'required|regex:/^[0-9]+(\.[0-9][0-9]?)?$/',
        ]);

        $ad = Ads::where('ad_id', $request->id)->where('user_id', Auth()->user()->id)->first();
        
        if($ad) {
            $ad->ad_title = $request->title;
            $ad->ad_description = $request->description;  
            $ad->ad_price = $request->price;
            $ad->cat_id = $request->category;
            $ad->sub_id = $request->subcategory;
            $ad->loc_id = $request->location;
            $ad->sold = $request->status;
            $ad->save();
            $adid = $ad->ad_id;
            return redirect()->route('ads.edit', ['id' => $adid])->with('status', 'Success update your ad');
        }else {
            abort(401);
        }
    }
}
