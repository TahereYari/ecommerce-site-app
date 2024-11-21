<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    protected $fillable =['name','price','description','counter','image','file','video','free','category_id'];

    function license()  {
        return $this->hasMany(license::class)->get();
    }

    public function category(){
        return $this->belongsTo(Category::class)->first();  
     }
}
