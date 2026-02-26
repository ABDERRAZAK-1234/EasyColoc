<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Membership extends Model
{
    protected $fillable = [];
    public function colocation()
    {
        return $this->belongsTo(Colocation::class);
    }
    public function user(){
        return $this->belongsTo(User::class);
    }
}
