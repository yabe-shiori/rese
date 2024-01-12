<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;
use App\Models\Favorite;
use App\Models\Reservation;
use Carbon\Carbon;

class ProfileController extends Controller
{
    /**
     * Display the user's profile form.
     */
    public function edit(Request $request): View
    {
        return view('profile.edit', [
            'user' => $request->user(),
        ]);
    }

    /**
     * Update the user's profile information.
     */
    public function update(ProfileUpdateRequest $request): RedirectResponse
    {
        $request->user()->fill($request->validated());

        if ($request->user()->isDirty('email')) {
            $request->user()->email_verified_at = null;
        }

        $request->user()->save();

        return Redirect::route('profile.edit')->with('status', 'profile-updated');
    }

    /**
     * Delete the user's account.
     */
    public function destroy(Request $request): RedirectResponse
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current_password'],
        ]);

        $user = $request->user();

        Auth::logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }

    public function index()
    {
        $user_id = Auth()->id();
        // 現在の日時を取得
        $now = Carbon::now();

        $favorites = Favorite::where('user_id', $user_id)->get();

        $reservations = Reservation::where('user_id', $user_id)
            ->where(function ($query) use ($now) {
                // 現在日時より後の予約を取得
                $query->where('reservation_date', '>', $now->toDateString())
                    ->orWhere(function ($query) use ($now) {
                        $query->where('reservation_date', $now->toDateString())
                            ->whereTime('reservation_time', '>', $now->toTimeString());
                    });
            })
            ->get();

        return view('mypage.index', compact('favorites', 'reservations'));
    }
}
