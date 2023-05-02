<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Request extends Model
{
    use HasFactory;




    protected $fillable = [
        'nama',
        'user_id',
        'pengajuan',
        'gambar',
        'harga',
        'deskripsi',
        'kondisi',
        'alamat',
        'provinsi',
        'kuantitas',
    ];

    protected $hidden = [
    ];

    protected $casts = [

    ];


    public function user(){
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function takeImage(){
        return "storage/" . $this->gambar;
    }

}
