<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Shop;
use App\Models\Reservation;

class ManagerController extends Controller
{
    //店舗代表者用ダッシュボード
    public function dashboard()
    {
        $shops = Shop::with('genre', 'area')->get();

        return view('managers.dashboard', compact('shops'));
    }

    //店舗情報作成画面表示
    public function create()
    {
        return view('managers.create');
    }
    //店舗情報作成処理
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:50',
            'description' => 'required|text|max:1000',
            'image' => 'nullable|image|max:2048',
            'genre_id' => 'required|integer',
            'area_id' => 'required|integer',
        ]);

        $shop = new Shop();
        $shop->name = $request->name;
        $shop->description = $request->description;
        $shop->genre_id = $request->genre_id;
        $shop->area_id = $request->area_id;

        // 画像アップロード処理
        $image = null;
        if ($request->hasFile('image')) {
            $image = $request->file('image')->store('shops', 'public');
        }

        // 店舗作成
        $shop = new Shop();
        $shop->name = $request->input('name');
        $shop->description = $request->input('description');
        $shop->image = $image;
        $shop->genre_id = $request->input('genre_id');
        $shop->area_id = $request->input('area_id');
        $shop->save();

        return redirect()->route('managers.dashboard')->with('message', '店舗情報が作成されました');
    }

    //店舗情報編集画面表示
    public function edit($id)
    {
        $shop = Shop::findOrFail($id);

        return view('managers.edit', compact('shop'));
    }

    //店舗情報更新処理
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:50',
            'description' => 'required|text|max:1000',
            'image' => 'nullable|image|max:2048',
            'genre_id' => 'required|integer',
            'area_id' => 'required|integer',
        ]);

        $shop = Shop::findOrFail($id);
        $shop->update([
            'name' => $request->input('name'),
            'description' => $request->input('description'),
            'genre_id' => $request->input('genre_id'),
            'area_id' => $request->input('area_id'),
        ]);
        return redirect()->route('managers.dashboard')->with('message', '店舗情報を更新しました');
    }

    //予約一覧画面
    public function index()
    {
        $reservations = Reservation::with('shop')->get();

        return view('managers.index', compact('reservations'));
    }
}
