<?php

namespace Gym\Model;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;
    const TYPE_ADMIN = 0;
    const TYPE_CLIENT = 1;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'type', 'disabled_at', 'note'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function getTypeString()
    {
        return $this->type == self::TYPE_ADMIN ? 'Administrator' : 'Gym client';
    }

}
