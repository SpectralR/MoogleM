<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $api = new \XIVAPI\XIVAPI();
        $api->environment->key(env('XIV_KEY'));

        $user = Auth::user();
        $char = $api->character->get($user->character_id, $data=[], $extended=true);

        return view('forum.member', [
            'user' => $user,
            'char' => $char
        ]);
    }
}
