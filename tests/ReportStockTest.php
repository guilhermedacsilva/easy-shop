<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use EasyShop\Model\User;
use EasyShop\Model\Product;

class ReportStockTest extends TestCase
{
    use WithoutMiddleware;
    use DatabaseTransactions;

    public function setUp()
    {
        parent::setUp();
        $this->actingAs(User::find(1));
    }

    public function testQuantityReport()
    {
        $this->visit('reports/stock/quantity');

        $products = Product::orderBy('name')->get();
        foreach ($products as $key => $product) {
            $childNumber = $key + 2;
            $this->within("tr:nth-child($childNumber)", function() use ($product) {
                $this->see($product->name)
                    ->see($product->quantity);
            });
        }
    }

    public function testInputReport()
    {
        echo get_class(DB);

        return;
        $this->visit('reports/stock/input');



        foreach ($products as $key => $product) {
            $childNumber = $key + 2;
            $this->within("tr:nth-child($childNumber)", function() use ($product) {
                $this->see($product->name)
                    ->see($product->quantity);
            });
        }
    }

}
