<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    public $guarded = [];
    protected $fillable = [
        'title',
        'description',
        'status',
        'deadline',
    ];

    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
        'deadline' => 'datetime',
    ];
    public function client()
    {
        return $this->belongsTo(Client::class);
    }
    public function timeLogs()
    {
        return $this->hasMany(TimeLog::class);
    }
}
