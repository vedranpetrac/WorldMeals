<?php

namespace App\Models;

use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;
use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Meal extends Model implements TranslatableContract
{
    use HasFactory;
    use SoftDeletes;
    use Translatable;

    public array $translatedAttributes = ['title', 'description'];
    protected $fillable = ['status'];

    public function category()
    {
        return $this->hasOne(Category::class, 'id', 'category_id');
    }

    public function tags()
    {
        return $this->belongsToMany(Tag::class, 'meal_tag','meal_id','tag_id');
    }
    public function ingredients()
    {
        return $this->belongsToMany(Ingredient::class, 'meal_ingredient','meal_id','ingredient_id');
    }

}

