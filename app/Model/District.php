<?php

namespace App\Models;

use App\Http\Filters\DistrictFilter;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class District extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'state_id',
        'country_id',
    ];

    public function country()
    {
        return $this->belongsTo('App\Models\Country');
    }

    /**
     * @return BelongsTo
     */
    public function state()
    {
        return $this->belongsTo('App\Models\State');
    }


    public function scopeFilter($query, DistrictFilter $filters)
    {
        return $filters->apply($query);
    }
}
