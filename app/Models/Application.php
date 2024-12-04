<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Application extends Model
{
    use HasFactory;
    protected $fillable = ['job_id', 'application_date', 'status', 'notes' ];

    public function jobs()
    {
        return $this->belongsTo(Jobs::class, 'job_id');
    }
}
