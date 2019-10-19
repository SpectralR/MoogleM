<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password','character_id', 'avatar'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
    * events relations
    */
    public function events(){
        return $this->belongsToMany('App\Event')->withPivot('participate');
    }

    /**
    * Roles relations
    */
    public function roles()
    {
        return $this->belongsToMany('App\Role');
    }

    public function isAdministrator() {
        return $this->roles()->where('name', 'Administrator')->exists();
        
     }

     public function isModerator() {
        return $this->roles()->where('name', 'Moderator')->exists();
     }

     public function isBanned() {
        return $this->roles()->where('name', 'Banned')->exists();
     }

    /**
    * message relations
    */
    public function messages()
    {
        return $this->hasMany('App\Message');
    }

    /**
    * sujets relations
    */
    public function topics()
    {
        return $this->hasMany('App\Topic');
    }
}
