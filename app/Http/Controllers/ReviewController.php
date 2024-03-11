<?php

namespace App\Http\Controllers;

use App\Models\Review;
use App\Models\Shop;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\StoreReviewRequest;
use Illuminate\Support\Facades\Storage;

class ReviewController extends Controller
{
    // 口コミ一覧表示
    public function index(Shop $shop)
    {
        $reviews = $shop->reviews()->with('reviewImages')->latest()->paginate(5);
        $satisfactions = [];

        foreach ($reviews as $review) {
            $satisfactions[$review->id] = $this->getSatisfaction($review->rating);
        }

        return view('reviews.index', compact('shop', 'reviews', 'satisfactions'));
    }

    // 評価に対する満足度を返す
    private function getSatisfaction($rating)
    {
        switch ($rating) {
            case 5:
                return '大変満足';
            case 4:
            case 3:
                return '満足';
            case 2:
                return 'やや不満';
            case 1:
                return '不満';
            default:
                return '';
        }
    }

    // 口コミ投稿画面
    public function create(Shop $shop)
    {
        if (!Auth::check()) {
            return redirect()->back()->with('error', 'ログインしてください。');
        }

        return view('reviews.create', compact('shop'));
    }

    // 口コミ投稿処理
    public function store(StoreReviewRequest $request, Shop $shop)
    {
        if (!Auth::check()) {
            return redirect()->back()->with('error', 'ログインしてください。');
        }

        $user = Auth::user();
        $existingReview = $user->reviews()->where('shop_id', $shop->id)->exists();

        if ($existingReview) {
            return redirect()->route('detail', $shop->id)->with('error', 'すでに口コミを投稿しています。');
        }

        $review = $user->reviews()->create([
            'shop_id' => $shop->id,
            'rating' => $request->rating,
            'comment' => $request->comment,
        ]);

        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                $filename = $image->store('review_images', 'public');
                $review->reviewImages()->create(['image' => $filename]);
            }
        }

        return redirect()->route('detail', $shop->id)->with('message', '口コミが投稿されました。');
    }

    // 口コミ編集画面
    public function edit(Review $review)
    {
        $user = Auth::user();

        if ($user->id !== $review->user_id) {
            return redirect()->back()->with('error', '編集できません。');
        }

        $shop = $review->shop;

        return view('reviews.edit', compact('review', 'shop'));
    }

    // 口コミ更新処理
    public function update(StoreReviewRequest $request, Review $review)
    {
        $user = Auth::user();

        if ($user->id !== $review->user_id) {
            return redirect()->back()->with('error', '口コミの所有者でないため、更新できません。');
        }

        $review->update([
            'rating' => $request->rating,
            'comment' => $request->comment,
        ]);

        $satisfaction = $this->getSatisfaction($review->rating);

        if ($request->hasFile('images')) {
            foreach ($review->reviewImages as $image) {
                Storage::delete($image->image);
                $image->delete();
            }

            foreach ($request->file('images') as $image) {
                $filename = $image->store('review_images', 'public');
                $review->reviewImages()->create(['image' => $filename]);
            }
        }

        return redirect()->route('detail', $review->shop_id)->with('message', '口コミが更新されました。')->with(compact('satisfaction'));
    }

    // 口コミ削除処理
    public function destroy(Review $review)
    {
        $user = Auth::user();

        if ($user->id === $review->user_id || $user->role === 'admin') {
            $shopId = $review->shop_id;
            $review->delete();

            return redirect()->route('detail', $shopId)->with('message', '口コミが削除されました。');
        }

        return redirect()->back()->with('error', '口コミを削除できません。');
    }
}
