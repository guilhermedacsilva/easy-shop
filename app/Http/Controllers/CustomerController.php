<?php

namespace EasyShop\Http\Controllers;

use Illuminate\Http\Request;
use EasyShop\Http\Traits\CrudActions;
use EasyShop\Model\Customer;

class CustomerController extends Controller
{
    use CrudActions;

    public function __construct() {
        $this->initCrud('Customer');
    }

}
