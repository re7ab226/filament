<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class State extends Model
{
    use HasFactory;
    protected $fillable=
    [
        'county_id',
        'name'
    ];
    public function Country():BelongsTo{
        return $this->belongsTo(Country::class);
    }
    public function employees():HasMany{
        return $this->hasMany(employee::class);
        }
        public function   Cities():HasMany{
            return $this->hasMany(city::class);
            }
}
