<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use EasyShop\Model\User;

class LoginTest extends TestCase
{
    public function testGuestUser()
    {
        $this->visit('/')
             ->seeInElement('.panel-heading','Login');
    }

    public function testLogin()
    {
        $this->actingAs(User::find(1))
            ->visit('/')
            ->seeInElement('.panel-body','You are logged in!');
    }
}
