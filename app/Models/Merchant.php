<?php

namespace App\Models;

use Illuminate\Support\Str;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Merchant extends Authenticatable
{

    protected $fillable = [
        'name',
        'email',
        'api_token',
    ];

    public function createToken()
    {
        $token = Str::random(60);
        $this->api_token = hash('sha256', $token);
        $this->save();

        return $token;
    }

}
