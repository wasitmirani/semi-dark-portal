<?php

namespace App\Models;

use Laravel\Passport\HasApiTokens;
use Illuminate\Notifications\Notifiable;


use Spatie\Activitylog\Traits\LogsActivity;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
   use HasApiTokens,SoftDeletes, HasFactory, Notifiable,LogsActivity;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */


    protected $guarded=[];

    protected static $logAttributes = ['name','email'];

    protected static $logAttributesToIgnore = ['password'];


    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */

    public function getDescriptionForEvent(string $eventName): string
    {
        return "{$eventName}";
    }


    public function user()
    {
        return $this->belongsTo(User::class);
    }
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
}
