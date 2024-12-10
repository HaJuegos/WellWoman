<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CicloMenstrual extends Model
{
    protected $table = "ciclos_menstruales";
    public $timestamps = false;
    protected $fillable = [
        "cycle_duration",
        "user_id",
        "lastPeriod",
        "period_duration",
        "pregnancy_probability",
        "luteal_phase",
        "sleep_hours",
        "water_intake",
        "desired_weight",
        "desired_height",
        "calorie_intake",
        "step_goal"
    ];

    public function usuario()
    {
        return $this->belongsTo(Usuario::class, 'user_id');
    }
}
