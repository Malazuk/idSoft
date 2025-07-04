<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Testing\Fluent\Concerns\Has;

class Citizen extends Model
{
    use HasFactory;
    // protected $table = 'citizen'; // Explicitly use the singular table name
    protected $fillable = [
        'citizen_id', 'first_name', 'surname', 'other_names', 'hometown', 
        'date_of_birth', 'address', 'contact_info', 'photo_path',
        'gender',   // Add this
        'nin',      // Add this
    ];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($citizen) {
            $year = now()->year;
            $lastCitizen = self::whereYear('created_at', $year)->orderBy('id', 'desc')->first();
            $sequence = $lastCitizen ? intval(substr($lastCitizen->citizen_id, -4)) + 1 : 1;
            $citizen->citizen_id = sprintf('CIN-%s-%04d', $year, $sequence);
        });
    }
}
