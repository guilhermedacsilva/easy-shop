<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use EasyShop\Model\User;
use EasyShop\Model\Product;
use EasyShop\Model\ProductsMovement;

class ProductsMovementTest extends TestCase
{
    use WithoutMiddleware;
    use DatabaseTransactions;

    // THERE ISN'T THE SHOW PAGE

    public function setUp()
    {
        parent::setUp();
        $this->actingAs(User::find(1));
    }

    public function testProductsMovementObserver()
    {
        $product = factory(EasyShop\Model\Product::class)->create();
        $oldQuantity = $product->quantity;
        $movement = factory(EasyShop\Model\ProductsMovement::class)->create([
            'product_id' => $product->id
        ]);
        $this->assertEquals($oldQuantity + $movement->quantity, $product->fresh()->quantity);

        $movement->quantity += 10;
        $movement->save();
        $this->assertEquals($oldQuantity + $movement->quantity, $product->fresh()->quantity);

        $movement->delete();
        $this->assertEquals($oldQuantity, $product->fresh()->quantity);
    }

    public function testIndex()
    {
        $movement = factory(EasyShop\Model\ProductsMovement::class)->create();

        $this->visit('/movements')
            ->within('tr:nth-child(2)', function() use ($movement) {
                $this->see($movement->quantity)
                    ->see($movement->total_value)
                    ->see($movement->getType())
                    ->see($movement->product->name);
            });
    }

    public function testCreate()
    {
        $product = Product::find(1);

        $this->visit('/movements/create')
            ->type('333.33', 'quantity')
            ->type('22.22', 'total_value')
            ->select(ProductsMovement::TYPE_INPUT, 'type')
            ->select($product->id, 'product_id')
            ->press('Submit')
            ->seePageIs('/movements')
            ->within('tr:nth-child(2)', function() use ($product) {
                $this->see('333.33')
                    ->see('22.22')
                    ->see('Input')
                    ->see($product->name);
            });

        $this->assertEquals($product->quantity + 333.33, Product::find(1)->quantity);
    }

    public function testEdit()
    {
        $product = factory(EasyShop\Model\Product::class)->create();
        $oldQuantity = $product->quantity;
        $movement = factory(EasyShop\Model\ProductsMovement::class)->create([
            'product_id' => $product->id
        ]);

        $newMovement = factory(ProductsMovement::class)->make();

        $this->visit('/movements')
            ->within('tr:nth-child(2)', function() use ($movement, $product) {
                $this->see($movement->quantity)
                    ->see($movement->total_value)
                    ->see($movement->getType())
                    ->see($product->name);
            })
            ->visit("/movements/{$movement->id}/edit")
            ->type($newMovement->quantity, 'quantity')
            ->type($newMovement->total_value, 'total_value')
            ->select(ProductsMovement::TYPE_INPUT, 'type')
            ->select($product->id, 'product_id')
            ->press('Submit')
            ->seePageIs('/movements')
            ->within('tr:nth-child(2)', function() use ($newMovement, $product) {
                $this->see($newMovement->quantity)
                    ->see($newMovement->total_value)
                    ->see($product->name);
            });
    }

    public function testDestroy()
    {
        $product = factory(EasyShop\Model\Product::class)->create();
        $oldQuantity = $product->quantity;
        $movement = factory(EasyShop\Model\ProductsMovement::class)->create([
            'product_id' => $product->id
        ]);

        $this->visit('movements')
            ->within('tr:nth-child(2)', function() use ($movement, $product) {
                $this->see($movement->quantity)
                    ->see($movement->total_value)
                    ->see($movement->getType())
                    ->see($product->name);
            })
            ->visit("movements/{$movement->id}/edit")
            ->press('Delete')
            ->seePageIs('/movements')
            ->within('tr:nth-child(2)', function() use ($movement, $product) {
                $this->dontSee($movement->quantity)
                    ->dontSee($movement->total_value)
                    ->dontSee($product->name);
            });

        $product = $product->fresh();
        $this->assertEquals($oldQuantity, $product->quantity);
    }

}
