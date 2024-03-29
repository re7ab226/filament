<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;


class City extends Model
{
    use HasFactory;
    protected $fillable=
    [
        'state_id',
        'name'
    ];
    public function State():BelongsTo{
        return $this->belongsTo(State::class);
    }
  //this relation for one to many
    public function employees():HasMany{
        return $this->hasMany(employee::class,'city-id');
        }
}
