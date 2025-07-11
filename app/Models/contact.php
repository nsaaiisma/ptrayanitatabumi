<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class contact extends Model
{
    use HasFactory;
    protected $table = 'contact';
    protected $fillable = ['location', 'telephone', 'email', 'time_operational', 'created_by', 'updated_by'];
}
