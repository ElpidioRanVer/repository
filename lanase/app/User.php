<?php

namespace App;

use Illuminate\Notifications\Notifiable;
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
        'name', 'email', 'password', 'display', 'image', 'joined', 'status', 'reminder', 'remember', 'role'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function datasets(){
        return $this->belongsToMany('App\Dataset')->withPivot('order')->withTimestamps();
    }

    public function sessions(){
        return $this->hasMany('App\Session');
    }

    public function sample(){
        return $this->hasOne('App\Sample');
    }

    public function specimens(){
        return $this->hasMany('App\Specimen');
    }

    public function isAdmin() {
        if($this->role == 1){
            return true;
        }
        return false;
    }

    public function isUser() {
        if($this->role == 2){
            return true;
        }
        return false;
    }

}
