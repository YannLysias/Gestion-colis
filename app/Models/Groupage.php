<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Groupage extends Model
{
    protected $casts = [
        'colis_ids' => 'array',
    ];

    protected $guarded = [];
    protected $table = 'groupages';

    // Relation avec l'agence de réception
    public function agence()
    {
        return $this->belongsTo(AgenceTransfert::class, 'agence_id');   
    }
    public function colis()
    {
        return $this->hasMany(Colis::class, 'code_colis', 'colis_ids');
    }
}
