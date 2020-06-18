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
        'name', 'email', 'password','rolename'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
    'password', 'remember_token',
    ];

    public function tasks()
    {
        return $this->hasMany(Task::class, 'user_id');
    }

    public function roles()
    {
        return $this->belongsToMany('App\Role','role_user');
    }

    public function files()
    {
      return $this->hasMany(FileUpload::class);
    }

    public function uploads()
    {
       return $this->hasMany(Upload::class);
    }

    public function projedetay()
    {
      return $this->hasMany(Projedetay::class);
    }

    public function projedosyalari()
    {
       return $this->hasMany(ProjeDosyalari::class);
    }

    public function projekisileri()
    {
       return $this->hasMany(ProjeKisiler::class);
    }
}
