<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JourFerier extends Model
{
    use HasFactory;

    protected $fillable = ['date'];
}
