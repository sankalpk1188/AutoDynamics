<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GalleryCategory extends Model
{
    use HasFactory;

    protected $table = 'gallery_category';

    public function gallery(){
        return $this->hasMany(Gallery::class, 'cat_id');
    }
}
