<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Show extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 'capacity',
    ];

    public function schedules()
    {
        return $this->hasMany(TimeTable::class);
    }

    public function reserves()
    {
        return $this->schedules()->reserves;
    }
}
