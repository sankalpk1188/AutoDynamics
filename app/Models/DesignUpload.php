<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DesignUpload extends Model
{
    use HasFactory;

    protected $table = 'design_uploads';

    protected $fillable = [
        'name',
        'email',
        'company',
        'looking_for',
        'preferred_material',
        'annual_volume',
        'part_description',
        'program_name',
        'sop_timeline',
        'files',
        'ip_address',
        'status',
    ];

    protected $casts = [
        'files' => 'array',
    ];
}
