<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Accounts extends Model
{
    public function client() {

        return $this->belongsTo(Clients::class);
    }

    public function deposits() {

        return $this->hasMany(Deposits::class, 'account_id');
    }
}
