<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $table = 'category';
    public function products(){
    	return $this->hasMany(Product::class);
    }

    public function classified_products(){
    	return $this->hasMany(CustomerProduct::class);
    }

    public function category(){
        return $this->hasMany(Category::class, 'parent_id');
    }

    public function childrenCategory(){
        return $this->hasMany(Category::class, 'parent_id')->with('category');
    }

    public function parentCategory(){
        return $this->belongsTo(Category::class, 'parent_id');
    }    
}
