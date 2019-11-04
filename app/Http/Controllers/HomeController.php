<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {

    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $api = new \XIVAPI\XIVAPI();
        $api->environment->key('15d07397f2ee48f88c6e43897f6e7a8c71b310b5d79845adac2dc9dcfe54921b');

        $instancesGet = $api->search->find('Eden\'s')->results();
        $instances = [];
        foreach ($instancesGet->Results as $id => $name) {

            if(strpos($name->Name, 'Savage') !== false ){
                $instances[] = $name;
            }
        }

        return view('home')->with(['instances' => $instances]);
    }
}
