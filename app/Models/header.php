<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class header extends Model
{
    use HasFactory;
    protected $table = 'header';
    protected $fillable = [
        'logo', 'heading', 'subheading', 'description', 'image',
        'created_by', 'updated_by'
    ];
}
