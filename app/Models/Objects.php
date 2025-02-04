<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Objects extends Model
{
    use HasFactory;

    protected $table = 'objects';
    protected $fillable = [
        'id',
        'libele',
        'description',

    ];
//    protected static function boot(): void
//    {
//        parent::boot();
//        static::creating(function ($model) {
//            if (empty($model->id)) {
//                $model->id = Str::uuid()->toString();
//            }
//        });
//    }
}
