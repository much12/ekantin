<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    protected $primaryKey = "userId";
    public $timestamps = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
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

    // fungsi join ke tabel role
    public function role()
    {
        return $this->belongsTo('App\Roles', 'roleId');
    }

    // Fungsi Join ke Tabel Barang
    public function barang()
    {
        return $this->hasMany('App\Barang', 'userId');
    }

    // Fungsi Join Ke Tabel Withdraw
    public function withdraw()
    {
        return $this->hasMany('App\Withdraw', 'userId');
    }

    // Fungsi Join ke Tabel Topup History
    public function topupHistory()
    {
        return $this->hasMany('App\TopupHistory', 'userId');
    }
}
