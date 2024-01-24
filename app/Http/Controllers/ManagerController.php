<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Shop;
use App\Models\Reservation;
use App\Models\User;
use App\Models\Genre;
use App\Models\Area;
use Illuminate\Support\Facades\Storage;

class ManagerController extends Controller
{
    // 店舗代表者用ダッシュボード
    public function dashboard()
    {
        $user = auth()->user();

        $shops = $user->shop ? [$user->shop] : [];

        return view('managers.dashboard', compact('shops'));
    }

    // 店舗情報作成画面表示
    public function create()
    {
        $genres = Genre::all();
        $areas = Area::all();

        return view('managers.create', compact('genres', 'areas'));
    }

    // 店舗情報作成処理
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:50',
            'description' => 'required|string|max:1000',
            'image' => 'nullable|image|max:2048',
            'genre_id' => 'required|integer',
            'area_id' => 'required|integer',
        ]);

        $image = null;
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('images', 'public');
            $image = 'storage/' . $imagePath;
        }

        $shop = new Shop();
        $shop->name = $request->input('name');
        $shop->description = $request->input('description');
        $shop->image = $image;
        $shop->genre_id = $request->input('genre_id');
        $shop->area_id = $request->input('area_id');
        $shop->manager_id = auth()->id();
        $shop->save();

        return redirect()->route('managers.dashboard')->with('message', '店舗情報が作成されました');
    }

    // 店舗情報編集画面表示
    public function edit($id)
    {
        $shop = Shop::findOrFail($id);
        $genres = Genre::all();
        $areas = Area::all();

        if ($shop->manager_id != auth()->id()) {
            abort(403, 'Unauthorized action.');
        }

        return view('managers.edit', compact('shop', 'genres', 'areas'));
    }

    // 店舗情報更新処理
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:50',
            'description' => 'required|string|max:1000',
            'image' => 'nullable|image|max:2048',
            'genre_id' => 'required|integer',
            'area_id' => 'required|integer',
        ]);

        $shop = Shop::findOrFail($id);

        if ($shop->manager_id != auth()->id()) {
            abort(403, 'Unauthorized action.');
        }

        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('images', 'public');
            $newImage = 'storage/' . $imagePath;

            if ($shop->image) {
                Storage::disk('public')->delete(str_replace('storage/', '', $shop->image));
            }

            $shop->update(['image' => $newImage]);
        }

        $shop->update([
            'name' => $request->input('name'),
            'description' => $request->input('description'),
            'genre_id' => $request->input('genre_id'),
            'area_id' => $request->input('area_id'),
        ]);

        return redirect()->route('managers.dashboard')->with('message', '店舗情報を更新しました');
    }

    // 予約一覧画面
    public function index()
    {
        $user = auth()->user();
        $shop = $user->shop;

        if ($shop) {
            $reservations = Reservation::where('shop_id', $shop->id)->get();
        } else {
            $reservations = collect();
        }

        return view('managers.index', compact('reservations'));
    }
}
