<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Mail\NotificationMail;
use Illuminate\Support\Facades\Mail;


class AdminController extends Controller
{

    //管理画面表示
    public function index()
    {
        return view('admin.index');
    }

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

    //お知らせメール作成ページの表示
    public function createNotification()
    {
        return view('admin.notification', [

                'subject' => '',
                'content' => '',
        ]);
    }

    //お知らせメール作成処理
    public function sendNotification(Request $request)
    {
        $request->validate([
            'subject' => 'required|string|max:255',
            'content' => 'required|string',
            'sendTo' => 'required|in:all,managers',
        ]);

        $subject = $request->input('subject');
        $content = $request->input('content');
        $sendTo = $request->input('sendTo');

        $users = $sendTo === 'all' ? User::all() : User::where('role', 'manager')->get();

        foreach ($users as $user)
        {
            Mail::to($user->email)->send(new NotificationMail($subject, $content));
        }

        return redirect()->route('admin.index')->with('message', 'お知らせメールを送信しました');
    }

}
