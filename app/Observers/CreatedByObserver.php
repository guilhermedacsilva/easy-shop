<?php

namespace EasyShop\Observers;

use Auth;

class CreatedByObserver
{
    public function creating($record)
    {
        $record->created_by = Auth::user()->id;
    }

    public function updating($record)
    {
        $record->updated_by = Auth::user()->id;
    }
}
