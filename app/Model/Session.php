<?php

namespace Gym\Model;

use Illuminate\Database\Eloquent\Model;

class Session extends Model
{
    public $timestamps = false;

    protected $fillable = [
        'name', 'capacity', 'start_at_date', 'start_at_time', 'end_at_time', 'note'
    ];

}
