<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use EasyShop\Model\User;

class ProductTest extends TestCase
{
    use WithoutMiddleware;
    use DatabaseTransactions;

    public function setUp()
    {
        parent::setUp();
        $this->actingAs(User::find(1));
    }

    public function testIndex()
    {
        $this->visit('/products')
            ->seeInElement('td','Broom');
    }

    public function testCreate()
    {
        $this->visit('/products/create')
            ->type('Table', 'name')
            ->type('8', 'quantity')
            ->press('Submit')
            ->seePageIs('/products')
            ->seeInElement('td','Table')
            ->seeInElement('td','8');
    }

    public function testShow()
    {
        $response = $this->call('get', '/products/1');

        $this->see('Broom')
            ->see('10.00')
            ->see('Never updated.');

        $pattern = '/<strong>Created by:<\/strong>\s+Admin/';
        $this->assertRegExp($pattern, $response->content());
    }

    public function testEdit()
    {
        $this->visit('/products/1/edit')
            ->type('Notebook', 'name')
            ->type('12.34', 'quantity')
            ->press('Submit')
            ->seePageIs('/products')
            ->seeInElement('td','Notebook')
            ->seeInElement('td','12.34');

        $pattern1 = '/<strong>Created by:<\/strong>\s+Admin/';
        $pattern2 = '/<strong>Updated by:<\/strong>\s+Admin/';
        $html = $this->call('get', '/products/1')->content();
        $this->assertRegExp($pattern1, $html);
        $this->assertRegExp($pattern2, $html);
    }

    public function testDestroy()
    {
        $product = factory(EasyShop\Model\Product::class)->create();

        $this->visit('products')
            ->seeInElement('td', $product->name)
            ->delete('products/' . $product->id)
            ->visit('/products')
            ->dontSeeInElement('td', $product->name);
    }

}
