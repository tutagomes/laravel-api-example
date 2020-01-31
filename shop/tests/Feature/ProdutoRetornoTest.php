<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Produto;
class ProdutoRetornoTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    use RefreshDatabase;

    public function testExample()
    {
        $response = $this->get('/');

        $response->assertStatus(200);
    }
    public function testcriaProduto () {
        $response = $this->postJson('/api/produtos', ['title'=> 'teste', 'short_description' => 'teste', 'long_description' => 'yay', 'price' => 30, 'discount' => 10]);
        $response->assertSuccessful();
    }
    public function testRetornoProduto() {
        $pdt = factory(Produto::class)->create();
        $response = $this->get('/api/produtos');
        $response->assertStatus(200);
        $response->assertSee(30);
        $response->assertJsonStructure([
            'data' => [
                '*' => [
                  'id',
                  'title',
                  'short_description',
                  'long_description',
                  'price',
                  'discount'
                ]
              ]
        ]);
    }
}
