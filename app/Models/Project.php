<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    protected $fillable = [
        'title',
        'description',
        'github_url',
        'image',
        'user_id',
    ];
    
   public function techStacks() {
    return $this->belongsToMany(TechStack::class);
   }
};

