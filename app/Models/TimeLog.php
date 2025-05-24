<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class TimeLog extends Model
{
    public $guarded = [];
    protected $fillable = [
        'project_id',
        'user_id',
        'start_time',
        'end_time',
        'duration',
    ];

    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
        'start_time' => 'datetime',
        'end_time' => 'datetime',
    ];

    protected static function booted()
    {
        static::saving(function ($timeLog) {
            if ($timeLog->isDirty('start_time') || $timeLog->isDirty('end_time')) {
                $timeLog->hours = $timeLog->calculateHours();
            }
        });
    }

    public function calculateHours()
    {
        if ($this->start_time && $this->end_time) {
            return Carbon::parse($this->end_time)->diffInHours(Carbon::parse($this->start_time));
        }
        return null;
    }

    public function project()
    {
        return $this->belongsTo(Project::class); }
}
