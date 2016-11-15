<?php

namespace EasyShop\Http\Controllers;

use Illuminate\Http\Request;
use EasyShop\Http\Traits\CrudTrait;
use EasyShop\Model\Client;

class ClientController extends Controller
{
    use CrudTrait;

    public function __construct() {
        $this->crudModelName = 'Client';
    }

}
