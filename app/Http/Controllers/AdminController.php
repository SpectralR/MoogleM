<?php

namespace App\Http\Controllers;

use App\Role;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Repositories\UserRepoInterface;
use App\Repositories\EventRepoInterface;

class AdminController extends Controller
{

    /**
     * @return array|\Illuminate\Contracts\View\Factory|\Illuminate\View\View|mixed
     */
    public function index()
    {
        $events = DB::table('events')->select('id', 'name')->get();
        $roles = Role::select('id', 'name')->get();
        $users = User::select('id', 'name')->get();

        return view('admin', [
            'events' => $events,
            'roles' => $roles,
            'users' => $users
        ]);
    }

    public function changeRole()
    {

    }
}
