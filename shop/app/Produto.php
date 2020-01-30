<?php

namespace App;
use OwenIt\Auditing\Contracts\Auditable;
use Illuminate\Database\Eloquent\Model;
class Produto extends Model implements Auditable
{
   use \OwenIt\Auditing\Auditable;
   protected $table = 'produtos';
   protected $fillable = [
        'title', 'short_description', 'long_description', 'price', 'inventory', 'discount'
    ];
    protected $auditInclude = [
        'title', 'short_description', 'long_description', 'price', 'inventory', 'discount'
    ];
    public function precoComDesconto () {
        return $this->price - $this->price * ($this->discount/100);
    }
    public function economiaDe () {
        return $this->price - $this->precoComDesconto();
    }
}