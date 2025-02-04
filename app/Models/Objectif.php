<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Objectif extends Model
{
    use HasFactory;

    protected $fillable = [
        'code',
        'activite',
        'typologie',
        'valeur_cible',
        'unites',
        'periodicite',
        'commentaires',
    ];

    /**
     * Relation avec DomaineValeurElement pour l'activité
     */
    public function activites()
    {
        return $this->belongsTo(DomaineValeurElement::class, 'activite');
    }

    /**
     * Relation avec DomaineValeurElement pour la typologie
     */
    public function typologies()
    {
        return $this->belongsTo(DomaineValeurElement::class, 'typologie');
    }

    /**
     * Relation avec DomaineValeurElement pour l'unité
     */
    public function unite()
    {
        return $this->belongsTo(DomaineValeurElement::class, 'unites');
    }

    /**
     * Relation avec DomaineValeurElement pour la périodicité
     */
    public function periodicites()
    {
        return $this->belongsTo(DomaineValeurElement::class, 'periodicite');
    }
}
