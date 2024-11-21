<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Basket extends Model
{
    use HasFactory;
    protected $fillable =  ['price', 'user_id', 'invoiceNumber',];

    public function user()
    {
        return $this->belongsTo(User::class)->first();
    }


    public function basketProducts()
    {
        return $this->belongsToMany(BasketProduct::class);
    }
}
