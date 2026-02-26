<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Colocation extends Model
{
    protected $fillable = ['titre','description'];
    public function memberships()
    {
        return $this->hasMany(Membership::class);
    }
}
