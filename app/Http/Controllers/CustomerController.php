<?php

namespace EasyShop\Http\Controllers;

use Illuminate\Http\Request;
use EasyShop\Http\Traits\CrudActions;
use EasyShop\Model\Person;

class CustomerController extends Controller
{
    use CrudActions;

    public function __construct() {
        $this->initCrud([
            'model' => 'Person',
            'routePrefix' => 'customers',
            'titleCreate' => 'Customer',
        ]);
    }

}
