<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Produk extends Model
{
    use HasFactory;

    protected $table = 'produk';

    protected $fillable = [
        'nama',
        'gambar',
        'harga',
        'deskripsi',
        'kondisi',
        'alamat',
        'provinsi',
        'kuantitas',
    ];

    var $provinces= [];
    
    //

    protected $hidden = [

    ];

    protected $casts = [

    ];

    public function takeImage(){
        return "storage/" . $this->gambar;
    }

    public function  getArray(){

    }

}
