<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class DomaineValeurElement extends Model
{
    public $incrementing = false;
    protected $fillable = [
        'id', 'libele', 'type', 'id_domaine'
    ];
    public function domaineValeur()
    {
        return $this->belongsTo(DomaineValeur::class, 'id_domaine');
    }
    protected static function boot(): void
    {
        parent::boot();
        static::creating(function ($model) {
            if (empty($model->id)) {
                $model->id = Str::uuid()->toString();
            }
        });
    }
}
