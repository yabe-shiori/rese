<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Favorite;
use Illuminate\Support\Facades\Auth;

class FavoriteController extends Controller
{
    //お気に入り追加
    public function favorite(Request $request)
    {
        if (!auth()->check()) {
            return back()->with('error', 'ログインしてください');
        }

        $user_id = Auth::user()->id;
        $shop_id = $request->input('shop_id');

        $exists = Favorite::where('user_id', $user_id)->where('shop_id', $shop_id)->exists();
        if (!$exists) {
            Favorite::create([
                'user_id' => $user_id,
                'shop_id' => $shop_id,
            ]);
        }

        return back();
    }

    //お気に入り削除
    public function removeFavorite(Request $request)
    {
        $user_id = Auth::user()->id;
        $shop_id = $request->input('shop_id');
        $favorite = Favorite::where('user_id', $user_id)->where('shop_id', $shop_id);
        if ($favorite->exists()) {
            $favorite->delete();
        }
        return back();
    }
}
