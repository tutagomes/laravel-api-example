<?php

namespace App;
use OwenIt\Auditing\Contracts\Auditable;
use Illuminate\Database\Eloquent\Model;
class Produto extends Model implements Auditable
{
   use \OwenIt\Auditing\Auditable;
   protected $table = 'produtos';
   protected $fillable = [
        'title', 'short_description', 'long_description', 'price', 'inventory'
    ];
    protected $auditInclude = [
        'title', 'short_description', 'long_description', 'price', 'inventory'
    ];
}