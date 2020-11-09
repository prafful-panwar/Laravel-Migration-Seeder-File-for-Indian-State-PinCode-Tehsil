<?php

namespace App\Models;

use App\Http\Filters\PinCodeFilter;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class PinCode extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'pin_code',
        'district_id',
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function district()
    {
        return $this->belongsTo('App\Models\District');
    }

    public function scopeFilter($query, PinCodeFilter $filters)
    {
        return $filters->apply($query);
    }
}
