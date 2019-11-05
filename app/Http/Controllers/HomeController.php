<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use XIVAPI\Api\SearchFilters;
use function GuzzleHttp\Promise\all;

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
//        $api = new \XIVAPI\XIVAPI();
//        $api->environment->key('15d07397f2ee48f88c6e43897f6e7a8c71b310b5d79845adac2dc9dcfe54921b');
//
//        $instancesGet = $api->content->contentFinderCondition()->list();
//
//        $instances = [];
//        foreach ($instancesGet->Results as $id => $name) {
//            dd($name->Name);
//            if(strpos($name->Name, 'Savage') !== false ){
//                $instances[] = $name;
//            }
//        }

        return view('home');
    }
}
