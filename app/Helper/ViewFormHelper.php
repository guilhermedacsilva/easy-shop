<?php

namespace EasyShop\Helper;

class ViewFormHelper
{
    public static function createSelectList(
        $collection,
        $colValue = 'name',
        $colId = 'id'
    ) {
        return $collection->pluck($colValue, $colId)->prepend('---', '');
    }
}
