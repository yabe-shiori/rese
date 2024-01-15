<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;


class AdminController extends Controller
{
    //管理者が店舗代表者を作成する管理画面
    public function createManager()
    {
        return view('admin.create');
    }

    //管理者が店舗代表者を作成する処理
    public function storeManager(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:191',
            'email' => 'required|email|unique:users|max:191',
            'password' => 'required|string|min:8|max:191',
        ]);

        $manager = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'role' => 'manager',
        ]);

        $manager->save();

        return redirect()->route('admin.create')->with('message', '店舗代表者が作成されました');
    }
}
