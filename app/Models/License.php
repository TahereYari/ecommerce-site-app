<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class License extends Model
{
    use HasFactory;
    protected $filable =['product_id','type','cost'];

    function product() {
        return $this->BelongsTo(Product::class)->first();
    }
    function basketProduct() {
        return $this->BelongsTo(BasketProduct::class);
    }


    public function licenseRecords()
    {
        return $this->hasMany(LicenseRecords::class);
    }
}
