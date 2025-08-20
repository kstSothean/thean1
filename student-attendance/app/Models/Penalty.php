<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Penalty extends Model
{
    /** @use HasFactory<\Database\Factories\PenaltyFactory> */
    use HasFactory;

    protected $fillable = [
        'student_id',
        'reason',
        'fine_amount',
    ];

    public function student()
    {
        return $this->belongsTo(Student::class);
    }
}
