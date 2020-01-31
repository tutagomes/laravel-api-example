<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Produto;
use Illuminate\Support\Facades\App;
use Illuminate\Foundation\Testing\WithFaker;

class ProdutoTest extends TestCase
{
    /**
     * A basic unit test example.
     *
     * @return void
     */
    use WithFaker;
    public function testCalculoDesconto()
    {
        $produto = new Produto;
        $produto->price = 30;
        $produto->discount = 100;
        $this->assertEquals($produto->precoComDesconto(), 0);
        $this->assertEquals($produto->economiaDe(), 30);
        
        $pdt = factory(Produto::class)->make();
        $this->assertEquals($pdt->precoComDesconto(), 27);
    }
}
