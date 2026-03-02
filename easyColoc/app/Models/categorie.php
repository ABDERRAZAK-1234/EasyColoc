<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Categorie extends Model
{
    protected $fillable = ['titre'];

    public function Depenses()
    {
        return $this->hasMany(Depense::class);
    }
}
