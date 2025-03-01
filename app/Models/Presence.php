<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Testing\Fluent\Concerns\Has;

class Presence extends Model
{
    use HasFactory;
    protected $fillable = ['intervenant_id', 'date', 'heure_arrivee', 'heure_depart', 'presentOrAbsent'];

    public function intervenant() {
        return $this->belongsTo(Intervenant::class);
    }
}
