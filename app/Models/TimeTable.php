<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TimeTable extends Model
{
    use HasFactory;

    protected $fillable = [
        'day', 'time'
    ];

    public function show()
    {
        return $this->belongsTo(Show::class);
    }

    public function reserves()
    {
        return $this->belongsToMany(Viewer::class, 'reservations')->withTimestamps();
    }
}
