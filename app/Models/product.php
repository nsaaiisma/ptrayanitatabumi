<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class product extends Model
{
    use HasFactory;
    protected $table = 'product';
    protected $fillable = [
        'name', 'category', 'description', 'price',
        'location', 'size', 'theme', 'image', 'status',
        'created_by', 'updated_by'
    ];
}
