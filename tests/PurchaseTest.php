<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use EasyShop\Model\User;
use EasyShop\Model\Product;
use EasyShop\Model\Trade;

class PurchaseTest extends TestCase
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
        $trades = Trade::orderBy('created_at', 'desc')->get();

        $this->visit('purchases');
        $row = 2;
        foreach ($trades as $trade) {
            $this->within("tr:nth-child($row)", function() use ($trade) {
                $this->see($trade->final_value);
            });
            $row++;
        }
    }
/*
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
        $this->visit('/products/1')
            ->see('Broom')
            ->see('10.00')
            ->see('Never updated.');

        $pattern = '/<strong>Created by:<\/strong>\s+Admin/';
        $this->assertRegExp($pattern, $this->response->content());
    }

    public function testEdit()
    {
        $this->visit('/products/1/edit')
            ->type('Notebook', 'name')
            ->type('12.34', 'quantity')
            ->press('Submit')
            ->seePageIs('/products')
            ->seeInElement('td','Notebook')
            ->seeInElement('td','12.34')
            ->visit('/products/1');

        $pattern1 = '/<strong>Created by:<\/strong>\s+Admin/';
        $pattern2 = '/<strong>Updated by:<\/strong>\s+Admin/';
        $html = $this->response->content();
        $this->assertRegExp($pattern1, $html);
        $this->assertRegExp($pattern2, $html);
    }

    public function testDestroyWithoutRelationship()
    {
        $product = factory(EasyShop\Model\Product::class)->create();

        $this->visit('products')
            ->seeInElement('td', $product->name)
            ->delete('products/' . $product->id)
            ->visit('/products')
            ->dontSeeInElement('td', $product->name);
    }

    public function testDestroyWithRelationship()
    {
        $product = Product::find(1);

        $this->visit('products')
            ->seeInElement('td', $product->name)
            ->makeRequest('delete', "products/1")
            ->seePageIs('products')
            ->see(trans('validation.delete_referenced'));
    }
*/
}
