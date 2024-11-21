<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Team extends Model
{
    use HasFactory;
    protected $fillable=[
        'name',
        'slug'
    ];

    public function User():BelongsToMany{
        return $this->belongsToMany(User::class);
        
    }
    public function customers():HasMany{
        return $this->hasMany(customer::class);
        
    }
}