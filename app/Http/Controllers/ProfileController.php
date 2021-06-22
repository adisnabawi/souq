<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Ads;
use App\Models\User;

class ProfileController extends Controller
{
    public function index(Request $request)
    {
        $poster = User::select('name', 'id', 'email')->where('id', $request->id)->first();
        if($poster){
            $ads = Ads::with('image', 'status')->where('user_id', $request->id)->latest()->paginate(12);
            return view('profile.public', compact('poster', 'ads'));
        }else {
            abort(404);
        }
        
    }
}
