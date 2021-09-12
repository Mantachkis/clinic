<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pet extends Model
{
    use HasFactory;


    public function getOwner()
    {
        return $this->belongsTo('App\Models\Owner', 'owner_id', 'id');
    }
    public function getDoctor()
    {
        return $this->belongsTo('App\Models\Doctor', 'doctor_id', 'id');
    }
}