<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Barang extends Model
{
    protected $table = "ms_barang";
    protected $primaryKey = "idBarang";
    public $timestamps = false;

    // Fungsi Join dari tabel user
    public function user()
    {
        return $this->belongsTo('App\User', 'userId');
    }
}
