<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Viewer extends Model
{
    use HasFactory;

    protected $fillable = [
        'first_name', 'last_name', 'national_code'
    ];

    public function reserves()
    {
        return $this->belongsToMany(TimeTable::class, 'reservations')->withTimestamps();
    }
}
