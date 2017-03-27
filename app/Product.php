<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use SoftDeletes;
    protected $fillable = ['category_id', 'subcategory_id', 'name', 'slug', 'author', 'price', 'condition', 'weight', 'synopsis', 'notes'];

    # Default
    public static function boot()
    {
        parent::boot();

        static::saving(function($model) {
            $slug = new \App\Services\Slug(\App\Product::class);
            $model->slug = $slug->create($model->name);
            $model->featured = 0;
            $model->status = 1;

            return true;
        });
    }

    # Mutator
    public function getCategoryAttribute(){
        $category = \App\Category::find($this->category_id);
        $this->category_id = $category->name;

        return $this->category_id;
    }

    public function getSubCategoryAttribute(){
        $subcategory = \App\SubCategory::find($this->subcategory_id);
        $this->subcategory_id = $subcategory->name;

        return $this->subcategory_id;
    }

    /**
     * Get the category record associated with the product.
     */
    public function category()
    {
        return $this->hasOne('App\Category');
    }

    /**
     * Get the subcategory record associated with the product.
     */
    public function subcategory()
    {
        return $this->hasOne('App\Subcategory');
    }

    /**
     * Get the product images record associated with the product.
     */
    public function productImages()
    {
        return $this->hasMany('App\ProductImage');
    }

    /**
     * Get the product images record associated with the product.
     */
    public function shop()
    {
        return $this->belongsTo('App\Shop');
    }
}
