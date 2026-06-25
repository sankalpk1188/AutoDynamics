<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LinkedinPost extends Model
{
    use HasFactory;

    protected $table = 'linkedin_posts';

    protected $fillable = [
        'title',
        'embed_code',
        'sort_order',
        'status',
    ];
}
