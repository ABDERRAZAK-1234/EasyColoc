<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Depense extends Model
{


    public function colocation()
    {
        return $this->belongsTo(Colocation::class);
    }
}
