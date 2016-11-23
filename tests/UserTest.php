<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use EasyShop\Model\User;

class UserTest extends TestCase
{
    use WithoutMiddleware;
    use DatabaseTransactions;

    public function testIndex()
    {
        $this->visit('/users')
            ->seeInElement('td','admin@admin.com');
    }

    public function testCreate()
    {
        $this->visit('/users/create')
            ->type('John', 'name')
            ->type('john@john.com', 'email')
            ->type('1234567890', 'password')
            ->type('1234567890', 'password_confirmation')
            ->press('Submit')
            ->seePageIs('/users')
            ->seeInElement('td','john@john.com');
    }

    public function testShow()
    {
        $this->visit('/users/1')
            ->seeInElement('.form-group','admin@admin.com');
    }

    public function testEdit()
    {
        $this->visit('/users/1/edit')
            ->type('Sam', 'name')
            ->type('sam@sam.com', 'email')
            ->press('Submit')
            ->seePageIs('/users')
            ->seeInElement('td','Sam')
            ->seeInElement('td','sam@sam.com');
    }

    public function testDestroy()
    {
        $this->actingAs(User::find(1))
            ->visit('/users')
            ->seeInElement('td', 'guy@guy.com')
            ->delete('/users/2')
            ->assertRedirectedTo('/users')
            ->visit('/users')
            ->dontSeeInElement('td','guy@guy.com');
    }

    public function testEditPassword()
    {
        $this->visit('/users/1/password')
            ->seeInElement('.form-group', 'admin@admin.com')
            ->type('abcdef', 'password')
            ->type('abcdef', 'password_confirmation')
            ->press('Submit')
            ->seePageIs('/users');

        $this->assertTrue(password_verify('abcdef', User::find(1)->password));
    }
}
