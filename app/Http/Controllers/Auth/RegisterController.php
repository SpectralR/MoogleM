<?php

namespace App\Http\Controllers\Auth;

use App\Role;
use App\User;
use App\Event;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    public function register(Request $request)
    {
        $this->validator($request->all())->validate();

        event(new Registered($user = $this->create($request->all())));

        return $this->registered($request, $user)
            ? redirect($this->redirectPath()) : redirect('register')->with('error', 'Character was not found!') ;

    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        $messages = [
            'char_name.regex' => 'your character name has this format: name lastname',
            'unique' => 'this :attribute must be unique',
        ];

        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255', 'unique:users'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'char_name' => ['required', 'string', 'regex:/([A-z])\w+\s([A-z])\w+/'],
            'char_serv' => ['required']
        ],
        $messages);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    {
        $api = new \XIVAPI\XIVAPI();
        $api->environment->key(config('services.xiv.key'));
        $char = $api->character->search(strtolower($data['char_name']), $data['char_serv']);
        $role = Role::where('name', '=', 'Member')->get();

        if (count($char->Results) == 0)
        {
            return false;
        } else {
            $user = new User([
                'name' => $data['name'],
                'email' => $data['email'],
                'character_id' => $char->Results[0]->ID,
                'avatar' => $char->Results[0]->Avatar,
                'password' => Hash::make($data['password']
            ),
            ]);

            $user->save();
            $user->roles()->attach($role);

            $events = Event::all();

            foreach ($events as $event) {
                $event->user()->attach($user->id);
            }

            return $user;
        }
    }
}
