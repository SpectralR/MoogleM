<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CharController extends Controller
{
    protected $user;

    /**
     * @return array|\Illuminate\Contracts\View\Factory|\Illuminate\View\View|mixed
     */
    public function static()
    {
        $api = new \XIVAPI\XIVAPI();
        $api->environment->key('15d07397f2ee48f88c6e43897f6e7a8c71b310b5d79845adac2dc9dcfe54921b');

        $users = DB::table('users')->get();
        $chars= [];
        foreach ($users as $user) {
            $char = $api->character->get($user->character_id, $data=[], $extended=true);
            $chars[] = $char;
        }

        return view('static', [
            'chars' => $chars
        ]);
    }

    /**
     * @param $id
     * @return array|\Illuminate\Contracts\View\Factory|\Illuminate\View\View|mixed
     */
    public function member($id)
    {
        $api = new \XIVAPI\XIVAPI();
        $api->environment->key(env('XIV_KEY'));

        $user = DB::table('users')->find($id);
        $char = $api->character->get($user->character_id, $data=[], $extended=true);

        return view('forum/member', [
            'char' => $char,
            'user' => $user
        ]);
    }
}
