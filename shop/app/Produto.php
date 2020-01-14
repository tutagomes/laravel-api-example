<?php

namespace App;
// https://laravel.com/docs/6.x/eloquent
use Illuminate\Database\Eloquent\Model;

class Produto extends Model
{
    protected $table = 'produtos';
   protected $fillable = [
        'title', 'short_description', 'long_description', 'price', 'inventory'
    ];
}