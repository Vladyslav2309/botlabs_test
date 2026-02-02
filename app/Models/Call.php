<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Call extends Model
{

    protected $fillable = [
        'lead_id',
        'manager_id',
        'duration',
        'result'
    ];


    public function lead()
    {
        return $this->belongsTo(Lead::class);
    }

}
