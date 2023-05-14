<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PaymentItem extends Model
{
    use HasFactory;

    protected $fillable = [
        'payment_id',
        'product_id',
        'product_name',
        'product_price',
        'quantity',
    ];

    public function payment()
    {
        return $this->belongsTo(Transaction::class, 'payment_id', 'id');
        // return $this->hasMany(Transaction::class, 'id', 'payment_id');

    }

    // public function user(){
    //     return $this->belongsTo(User::class, 'user_id', 'id');
    // }

}
