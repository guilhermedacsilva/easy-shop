<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use EasyShop\Model\User;
use EasyShop\Model\Person;

class PersonCustomerTest extends TestCase
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
        $this->visit('/customers')
            ->seeInElement('td', 'Bill')
            ->seeInElement('td', 'John');
    }

    public function testCreate()
    {
        $this->visit('/customers/create')
            ->type('Bruno', 'name')
            ->press('Submit')
            ->seePageIs('/customers')
            ->seeInElement('td', 'Bruno');
    }

    public function testShow()
    {
        $this->visit('/customers/1')
            ->see('John');
    }

    public function testEdit()
    {
        $this->visit('/customers/1/edit')
            ->type('Wesley', 'name')
            ->press('Submit')
            ->seePageIs('/customers')
            ->seeInElement('td', 'Wesley');
    }

    public function testDestroyWithoutRelationship()
    {
        $customer = factory(EasyShop\Model\Person::class, 'customer')->create();

        $this->visit('customers')
            ->seeInElement('td', $customer->name)
            ->delete("customers/$customer->id")
            ->visit('/customers')
            ->dontSeeInElement('td', $customer->name);
    }
}
