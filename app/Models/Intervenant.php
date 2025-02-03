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
    protected static function boot(): void
    {
        parent::boot();
        static::creating(function ($model) {
            if (empty($model->id)) {
                $model->id = Str::uuid()->toString();
            }
        });
    }


    public function domaineElement(): BelongsTo
    {
        return $this->belongsTo(DomaineValeurElement::class, 'fonction');
    }
}
