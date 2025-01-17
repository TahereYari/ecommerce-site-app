<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LicenseRecords extends Model
{
    use HasFactory;

    public function license()
    {
        return $this->belongsTo(License::class);
    }

    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
