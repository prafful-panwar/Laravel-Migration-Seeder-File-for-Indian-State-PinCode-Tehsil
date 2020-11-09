<?php

namespace App\Models;

use App\Http\Filters\StateFilter;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class State extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'code',
        'country_id',
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function country()
    {
        return $this->belongsTo('App\Models\Country');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function cities()
    {
        return $this->hasMany('App\Models\District');
    }


    public function getDoctorRegistrationStateData()
    {
        return [
            'state_id' => $this->id,
            'state_name' => $this->name,
        ];
    }

    public function scopeFilter($query, StateFilter $filters)
    {
        return $filters->apply($query);
    }
}
