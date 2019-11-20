<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Clients extends Model
{
    public function accounts() {

        return $this->hasMany(Accounts::class, 'client_id');
    }
}
