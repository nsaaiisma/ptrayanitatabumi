<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class title extends Model
{
    use HasFactory;
    protected $table = 'title';
    protected $fillable = [
        'captionProduct', 'descriptionProduct',
        'captionPortofolio', 'descriptionPortofolio',
        'captionAboutMe', 'descriptionAboutMe', 'owner_image', 'owner_description',
        'captionTestimoni', 'descriptionTestimoni',
        'created_by', 'updated_by'
    ];
}
