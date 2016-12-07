<?php

use EasyShop\Model\User;
use EasyShop\Model\Trade;
use EasyShop\Model\Product;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

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
        $purchases = Trade::with('person')
                        ->where('type', '=', Trade::TYPE_PURCHASE)
                        ->orderBy('created_at', 'desc')
                        ->get();

        $this->visit('purchases');
        $row = 2;
        foreach ($purchases as $purchase) {
            $this->within("tr:nth-child($row)", function () use ($purchase) {
                $this->see($purchase->total_value)
                    ->see($purchase->discount)
                    ->see($purchase->final_value);

                if ($purchase->person) {
                    $this->see($purchase->person->name);
                }
            });
            $row++;
        }

        $sales = Trade::with('person')
                        ->where('type', '=', Trade::TYPE_SALE)
                        ->get();

        foreach ($sales as $sale) {
            $this->dontSee($sale->total_value)
                ->dontSee($sale->discount)
                ->dontSee($sale->final_value);
        }
    }

    public function testCreate()
    {
        $this->visit('purchases/create')
            ->select('3', 'supplier')
            ->press('Open purchase');

        $record = Trade::latest()->first();
        $this->seePageIs("purchases/$record->id/edit");
    }

    public function testEdit()
    {
        $purchase = Trade::create([
            'type' => Trade::TYPE_PURCHASE,
        ]);
        $page = "purchases/$purchase->id/edit";
        $product = Product::find(1);
        $this->visit($page)
            ->select(1, 'product')
            ->type(10, 'quantity')
            ->type(20, 'total_value')
            ->press('Add to cart')
            ->seePageIs($page)
            ->within('tr:nth-child(2)', function () use ($product) {
                $this->see(10)
                    ->see(20)
                    ->see($product->name);
            });
    }

    /*
    public function testShow()
    {
        $this->visit('/products/1')
            ->see('Broom')
            ->see('10.00')
            ->see('Never updated.');

        $pattern = '/<strong>Created by:<\/strong>\s+Admin/';
        $this->assertRegExp($pattern, $this->response->content());
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
