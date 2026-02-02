<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Model;

class Lead extends Model
{

    protected $fillable = [
        'name',
        'phone',
        'status',
        'manager_id'
    ];

    protected $attributes = [
        'status' => 'new',
    ];
    protected $hidden = ['updated_at'];
    public function manager()
    {
        return $this->belongsTo(Manager::class);
    }

    public function calls()
    {
        return $this->hasMany(Call::class);
    }


    public function getCallsCountAttribute()
    {
        return $this->calls()->count();
    }

    public function getTotalCallDurationAttribute()
    {
        return $this->calls()->sum('duration');
    }
}
