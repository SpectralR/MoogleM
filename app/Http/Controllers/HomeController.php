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
//        $api->environment->key(env('XIV_KEY');
//
//        $instancesGet = $api->content->contentFinderCondition()->list();
////        $instancesGet = $api->content->instanceContent()->one(5027);
//        dd($instancesGet);
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

