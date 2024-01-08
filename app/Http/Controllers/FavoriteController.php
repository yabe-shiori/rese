<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Favorite;
use App\Models\Shop;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class FavoriteController extends Controller
{
    public function favorite(Request $request)
    {
        $user_id = Auth::user()->id;
        $shop_id = $request->input('shop_id');

        // 既にお気に入りに登録されていないか確認
        if (!Favorite::where(['user_id' => $user_id, 'shop_id' => $shop_id])->exists()) {
            $favorite = new Favorite();
            $favorite->user_id = $user_id;
            $favorite->shop_id = $shop_id;
            $favorite->save();
        }
        return back();
    }

    public function unfavorite(Request $request)
    {
        $user_id = Auth()->user()->id;
        $shop_id = $request->input('shop_id');

        Favorite::where(['user_id' => $user_id, 'shop_id => $shop_id'])->delete();

        return back();
    }

    public function index(Request $request)
    {
        $favorite = Favorite::where('user_id', Auth::user()->id)->where('shop_id', $request->shop->id)->first();
        return view('mypage.index', compact('favorite'));
    }

}
