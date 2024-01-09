<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Favorite;
use Illuminate\Support\Facades\Auth;

class FavoriteController extends Controller
{
    //お気に入り登録・削除
    // public function favorite(Request $request)
    // {
    //     $user_id = Auth::user()->id;
    //     $shop_id = $request->input('shop_id');
    //     $favorite = Favorite::where('user_id', $user_id)->where('shop_id', $shop_id);

    //     if($favorite->exists()) {
    //         $favorite->delete();
    //     } else {
    //         Favorite::create([
    //             'user_id' => $user_id,
    //             'shop_id' => $shop_id,
    //         ]);
    //     }
    //     return back();
    // }


    //お気に入り追加
    public function favorite(Request $request)
    {
        $user_id = Auth::user()->id;
        $shop_id = $request->input('shop_id');
        // お気に入りにまだ登録されていない場合にのみ、登録を行う
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
        // お気に入りが存在する場合にのみ、削除を行う
        $favorite = Favorite::where('user_id', $user_id)->where('shop_id', $shop_id);
        if ($favorite->exists()) {
            $favorite->delete();
        }
        return back();
    }

}
