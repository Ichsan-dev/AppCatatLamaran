<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Jobs extends Model
{
    use HasFactory;

    protected $fillable = ['company_id', 'position', 'description', 'requirements'];

    public function company()
    {
        return $this->belongsTo(Company::class, 'company_id');
    }
}
