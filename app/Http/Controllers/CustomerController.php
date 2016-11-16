<?php

namespace EasyShop\Http\Controllers;

use Illuminate\Http\Request;
use EasyShop\Http\Traits\CrudTrait;
use EasyShop\Model\Customer;

class CustomerController extends Controller
{
    use CrudTrait;

    public function __construct() {
        $this->crudModelName = 'Customer';
    }

}
