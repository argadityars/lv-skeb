<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = ['category_id', 'subcategory_id', 'name', 'slug', 'author', 'price', 'condition', 'weight', 'synopsis', 'notes'];

    public static function boot()
    {
        parent::boot();

        static::saving(function($model) {
            $model->slug = str_slug($model->name);
            $model->featured = 0;
            $model->status = 1;

            return true;
        });
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
        return $this->hasMany('App\ProductImages');
    }
}
