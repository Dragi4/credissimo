<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Deposits extends Model
{
    public function accounts() {

        return $this->belongsTo(Accounts::class);
    }

}
