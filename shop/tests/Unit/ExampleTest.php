<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Produto;
use Illuminate\Foundation\Testing\RefreshDatabase;
class ExampleTest extends TestCase
{
    use RefreshDatabase;

    /**
     * A basic test example.
     *
     * @return void
     */
    public function testBasicTest()
    {
        $pdt = factory(Produto::class)->create();
        $pdt = Produto::first();
        $this->assertEquals($pdt->id, 1);

        factory(Produto::class)->create();
        $produtos = Produto::all();
        $this->assertEquals(count($produtos), 2);
    }
}
