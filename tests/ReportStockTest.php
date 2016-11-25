<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use EasyShop\Model\User;
use EasyShop\Model\Product;
use EasyShop\Model\ProductsMovement;

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
        $type = ProductsMovement::TYPE_INPUT;
        $this->runTestInputOutputReportWithNoFilter($type);
        $this->runTestInputOutputReportWithFilter($type);
    }

    public function testOutputReport()
    {
        $type = ProductsMovement::TYPE_OUTPUT;
        $this->runTestInputOutputReportWithNoFilter($type);
        $this->runTestInputOutputReportWithFilter($type);
    }

    protected function runTestInputOutputReportWithNoFilter($type)
    {
        $url = 'reports/stock/' . strtolower(ProductsMovement::getStringType($type));
        $this->visit($url);

        $products = Product::orderBy('name')->get();
        $childNumber = 2;
        foreach ($products as $product) {
            $results = DB::select(<<<EOT
                select sum(quantity) as quantity
                from products_movements
                where product_id = $product->id and type = $type
EOT
            );
            $quantity = $results[0]->quantity;
            if (!$quantity) {
                continue;
            }
            $this->within("tr:nth-child($childNumber)", function() use ($product, $quantity) {
                $this->see($product->name)
                    ->see($quantity);
            });
            $childNumber++;
        }
    }

    protected function runTestInputOutputReportWithFilter($type)
    {
        $uri = 'reports/stock/' . strtolower(ProductsMovement::getStringType($type));
        $postData = [
            'start_at' => '2000-01-01',
            'end_at' => '2000-01-01',
        ];
        $this->makeRequest('POST', $uri, $postData);

        $products = Product::orderBy('name')->get();
        $childNumber = 2;
        foreach ($products as $product) {
            $results = DB::select(<<<EOT
                select sum(quantity) as quantity
                from products_movements
                where product_id = $product->id
                    and type = $type
                    and created_at between '2000-01-01 00:00:00' and '2000-01-01 23:59:59'
EOT
            );
            $quantity = $results[0]->quantity;
            if (!$quantity) {
                continue;
            }
            $this->within("tr:nth-child($childNumber)", function() use ($product, $quantity) {
                $this->see($product->name)
                    ->see($quantity);
            });
            $childNumber++;
        }
    }

}
