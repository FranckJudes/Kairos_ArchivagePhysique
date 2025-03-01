<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EntiteOrganisation extends Model
{
    use HasFactory;
    protected $fillable = ['code','libele','description','type_entity_id','parent_id'];


    public function childs() {
        return $this->hasMany('App\Models\Entite_organisation','parent_id','id') ;
    }

    public function type(){
        return $this->belongTo(TypeEntite::class,'type_entity_id');
    }

}
