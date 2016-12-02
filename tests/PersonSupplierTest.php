<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use EasyShop\Model\User;
use EasyShop\Model\Person;

class PersonSupplierTest extends TestCase
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
        $this->visit('/suppliers')
            ->seeInElement('td', 'Some Industry')
            ->seeInElement('td', 'Nails Store');
    }

    public function testCreate()
    {
        $this->visit('/suppliers/create')
            ->type('X Company', 'name')
            ->press('Submit')
            ->seePageIs('/suppliers')
            ->seeInElement('td', 'X Company');
    }

    public function testShow()
    {
        $this->visit('/suppliers/3')
            ->see('Some Industry');
    }

    public function testEdit()
    {
        $this->visit('/suppliers/3/edit')
            ->type('Happy Shop', 'name')
            ->press('Submit')
            ->seePageIs('/suppliers')
            ->seeInElement('td', 'Happy Shop');
    }

    public function testDestroyWithoutRelationship()
    {
        $supplier = factory(EasyShop\Model\Person::class, 'supplier')->create();

        $this->visit('suppliers')
            ->seeInElement('td', $supplier->name)
            ->delete("suppliers/$supplier->id")
            ->visit('/suppliers')
            ->dontSeeInElement('td', $supplier->name);
    }
}
