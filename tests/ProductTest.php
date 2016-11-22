<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use EasyShop\Model\User;

class ProductTest extends TestCase
{
    use WithoutMiddleware;
    use DatabaseTransactions;

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

    public function testStore()
    {
        $this->post('/products', [
            'name' => 'Mouse',
            'quantity' => '6',
        ])  ->assertRedirectedTo('/products')
            ->visit('/products')
            ->seeInElement('td','Mouse')
            ->seeInElement('td','6');
    }

    public function testShow()
    {
        $this->visit('/products/1')
            ->see('Broom')
            ->see('10.00');
            ->seeText('Created by: Admin at:');
    }
/*
    public function testEdit()
    {
        $this->visit('/products/1/edit')
            ->type('Sam', 'name')
            ->press('Submit')
            ->seePageIs('/products')
            ->seeInElement('td','Sam');
    }

    public function testUpdate()
    {
        $this->patch('/products/1', [
            'name' => 'Peter',
        ])  ->assertRedirectedTo('/products')
            ->visit('/products')
            ->seeInElement('td','Peter');
    }


    public function testDestroy()
    {
        $this->visit('/products')
            ->seeInElement('td', 'John')
            ->delete('/products/1')
            ->assertRedirectedTo('/products')
            ->visit('/products')
            ->dontSeeInElement('td','John');
    }
*/
}
