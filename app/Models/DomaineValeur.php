<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Str;

class DomaineValeur extends Model
{
    public $incrementing = false;
    use HasFactory;
    protected $fillable = [
        'libele',
        'description',
        'type',
    ];
    protected static function boot(): void
    {
        parent::boot();
        static::creating(function ($model) {
            if (empty($model->id)) {
                $model->id = Str::uuid()->toString();
            }
        });
    }

    public function domaine_valeurs_elements(): HasMany
    {
        return $this->hasMany(DomaineValeurElement::class, 'id_domaine');
    }
}
