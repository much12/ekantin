<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class authentication extends Model
{
    public function cekUser($user, $pass)
    {
        return DB::table('users')
            ->where('username', $user)
            ->where('password', $pass)
            ->first();
    }
}
