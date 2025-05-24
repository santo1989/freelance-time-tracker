<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    public $guarded = [];
    protected $fillable = [
        'name',
        'email',
        'contact_person',
    ];
    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];
    
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function projects()
    {
        return $this->hasMany(Project::class); }
}
