<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Depense extends Model
{

protected $fillable = ['titre','montant','date','colocation_id','categorie_id'];
    public function colocation()
    {
        return $this->belongsTo(Colocation::class);
    }
    
    public function categorie()
    {
        return $this->belongsTo(Categorie::class);
    }
}
