<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use EasyShop\Model\User;
use EasyShop\Model\ProductsMovement;
use DB;

class ProductsMovementTest extends TestCase
{
    use WithoutMiddleware;
    use DatabaseTransactions;

    public function testIndex()
    {
        DB::table('products_movements')->delete();

        $movement = ProductsMovement::create([
            'quantity' => 23.23,
            'total_value' => 34.34,
            'type' => ProductsMovement::TYPE_INPUT,
            'product_id' => 1,
            'created_by' => 1,
        ]);

        $this->visit('/movements')
            ->see('Movements');
    }

    public function testCreate()
    {
        DB::table('products_movements')->delete();

        $this->actingAs(User::find(1))
            ->visit('/movements/create')
            ->type('333.33', 'quantity')
            ->type('22.22', 'total_value')
            ->type(ProductsMovement::TYPE_INPUT, 'type')
            ->press('Submit')
            ->seePageIs('/movements')
            ->seeInElement('td','333.33')
            ->seeInElement('td','22.22')
            ->seeInElement('td','Input');
    }
/*
    public function testStore()
    {
        $this->actingAs(User::find(1))
             ->post('/movements', [
                'name' => 'Mouse',
                'quantity' => 6,
        ])->assertRedirectedTo('/movements')
            ->visit('/movements')
            ->seeInElement('td','Mouse')
            ->seeInElement('td','6');
    }

    public function testShow()
    {
        $response = $this->call('get', '/movements/1');

        $this->see('Broom')
            ->see('10.00')
            ->see('Never updated.');

        $pattern = '/<strong>Created by:<\/strong>\s+Admin/';
        $this->assertRegExp($pattern, $response->content());
    }

    public function testEdit()
    {
        $this->actingAs(User::find(1))
            ->visit('/movements/1/edit')
            ->type('Notebook', 'name')
            ->type('12.34', 'quantity')
            ->press('Submit')
            ->seePageIs('/movements')
            ->seeInElement('td','Notebook')
            ->seeInElement('td','12.34');
    }

    public function testUpdate()
    {
        $this->actingAs(User::find(1))
            ->patch('/movements/1', [
                'name' => 'Brick',
                'quantity' => '123.45',
        ])  ->assertRedirectedTo('/movements');

        $response = $this->call('get', '/movements/1');

        $this->see('Brick')
            ->see('123.45');

        $pattern = '/<strong>Created by:<\/strong>\s+Admin/';
        $this->assertRegExp($pattern, $response->content());
        $pattern = '/<strong>Updated by:<\/strong>\s+Admin/';
        $this->assertRegExp($pattern, $response->content());
    }

    public function testDestroy()
    {
        $product = factory(EasyShop\Model\Product::class)->make();
        $this->assertTrue($product->save());

        $this->visit('movements')
            ->seeInElement('td', $product->name)
            ->delete('movements/' . $product->id, [
                '_token' => csrf_token()
            ])
            ->visit('/movements')
            ->dontSeeInElement('td', $product->name);
    }
*/
}
