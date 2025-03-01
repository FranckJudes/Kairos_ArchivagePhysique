<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PostTravail extends Model
{
    use HasFactory;

    protected $fillable = ['code', 'intitule', 'description', 'entite_id'];

    public function entite()
    {
        return $this->belongsTo(EntiteOrganisation::class);
    }
}
