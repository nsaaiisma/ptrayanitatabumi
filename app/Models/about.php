<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class about extends Model
{
    use HasFactory;
    protected $table = 'about';
    protected $fillable = ['title', 'years', 'description', 'created_by', 'updated_by'];
}
