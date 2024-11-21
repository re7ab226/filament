<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class customer extends Model
{
    use HasFactory;
    protected $fillable=[
        'name',
        'team_id'
    ];
    public function Teams():BelongsTo
    {
       return $this->belongsTo(Team::class,'team_id');
        
    }
}