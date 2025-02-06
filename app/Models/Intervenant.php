<?php

namespace App\Models;

use App\Enums\SexeEnum;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Str;

class Intervenant extends Model
{
    use HasFactory;
    protected $fillable = [
        'id',
        'matricule',
        'firstname',
        'lastname',
        'date_of_birth',
        'lieu_naissance',
        'profession',
        'fonction',
        'date_integration',
        'info_connexes',
        'email',
        'phone',
        'photo_profil',
        'sex',
    ];

    protected $casts = [
        'sex' => SexeEnum::class,
        'date_of_birth' => 'date',
        'date_integration' => 'date'
    ];



    public function domaineElement(): BelongsTo
    {
        return $this->belongsTo(DomaineValeurElement::class, 'fonction');
    }
    public function activites()
    {
        return $this->belongsToMany(DomaineValeurElement::class, 'domaine_intervenants', 'intervenant_id', 'domaine_valeur_element_id');
    }
}
