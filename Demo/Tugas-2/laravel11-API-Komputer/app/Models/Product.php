<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute; 
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    /** 
     * fillable 
     * 
     * @var array 
     */ 

    protected $fillable = [
        'nama',
        'kategori',
        'harga',
        'stok',
        'dibeli',
        'image',
        'description',
        'brand',
    ];

    /** 
     * image 
     * 
     * @return Attribute 
     */ 
    protected function image(): Attribute 
    { 
        return Attribute::make( 
            get: fn ($image) => url('/storage/products/' . $image), 
        ); 
    } 
} 
