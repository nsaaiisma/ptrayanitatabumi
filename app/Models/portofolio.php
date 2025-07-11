<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class portofolio extends Model
{
    use HasFactory;
    protected $table = 'portofolio';
    protected $fillable = [
        'name', 'description', 'location', 'timeRange',
        'years', 'status', 'image', 'created_by', 'updated_by'
    ];
}
