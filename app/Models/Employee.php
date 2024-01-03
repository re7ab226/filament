<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;


class Employee extends Model
{
    use HasFactory;
    
    protected $fillable=
    [
        'county_id',
        'state_id',
        'city-id',
        'department-id',
        'f-name',
        'l-name',
        'email',
        'date_birth',
        'address',
    ];
    public function Country():BelongsTo{
        return $this->belongsTo(Country::class);
    }
    public function State():BelongsTo{
        return $this->belongsTo(State::class);
    }    public function Department():BelongsTo{
        return $this->belongsTo(Department::class);
    }    public function City():BelongsTo{
        return $this->belongsTo(City::class);
    }
}
