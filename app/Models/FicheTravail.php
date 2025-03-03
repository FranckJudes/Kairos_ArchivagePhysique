<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FicheTravail extends Model
{
    use HasFactory;

    protected $fillable = [
        'intitule',
        'mission',
        'lieu_du_poste',
        'condition',
        'post_travail_id',
        'competence'
    ];

    public function missionRelation()
    {
        return $this->belongsTo(DomaineValeurElement::class, 'mission');
    }

    public function postTravail()
    {
        return $this->belongsTo(PostTravail::class, 'post_travail_id');
    }
}
