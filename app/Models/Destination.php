<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Destination extends Model
{
    protected $table = "destination";
    protected $fillable = ['name', 'address'];
    
    public function invoice(){
        return $this->hasMany(Invoice::class);
    }
}
