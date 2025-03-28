<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
   public function techStacks() {
    return $this->belongsToMany(TechStack::class);
   }
}
