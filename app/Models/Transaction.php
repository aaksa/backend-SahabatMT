<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use HasFactory;

    protected $fillable = [
        'gross_amount',
        'customer_name',
        'customer_email',
        'customer_phone',
        'address',
        'status'
    ];

    public function items()
    {
        return $this->hasMany(PaymentItem::class, 'payment_id');
    }
}
