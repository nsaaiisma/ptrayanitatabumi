<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class feedback extends Model
{
    use HasFactory;
    protected $table = 'feedback';
    protected $fillable = ['name', 'email', 'rating', 'message', 'status', 'created_by', 'updated_by'];
}
