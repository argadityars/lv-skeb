<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Shop extends Model
{
    protected $fillable = ['province_id', 'city_id', 'name', 'slug', 'tagline', 'email', 'address', 'photo', 'banner', 'start_day', 'end_day', 'start_hour', 'end_hour', 'note', 'featured'];

    # Default
    public static function boot()
    {
        parent::boot();

        static::saving(function($model) {
            $model->slug = str_slug($model->name);

            return true;
        });
    }

    # Mutator

    # Accessor
    public function getProvince() {
        $this->province_id = DB::table('provinces')->where('id', $this->province_id)->first();
        return $this->province_id;
    }

    public function getCity() {
        $this->city_id = DB::table('regencies')->where('id', $this->city_id)->first();
        return $this->city_id;
    }

    public function getWorkDays(){

        if (!$this->start_day || !$this->end_day) {
            return null;
        }

        $start_day = $this->getDaysArray()[$this->start_day];
        $end_day = $this->getDaysArray()[$this->end_day];

        return $start_day. " - " . $end_day;
    }

    public function getWorkHours(){

        if (!$this->start_hour || !$this->end_hour) {
            return null;
        }

        $start_hour = new Carbon($this->start_hour);
        $end_hour = new Carbon($this->end_hour);

        return $start_hour->format('h.i A'). " - " .$end_hour->format('h.i A');
    }

    # Utility
    public function getDaysArray()
    {
        $timestamp = strtotime('next Sunday');
        $days = array();
        for ($i = 0; $i < 7; $i++) {
            $days[] = strftime('%A', $timestamp);
            $timestamp = strtotime('+1 day', $timestamp);
        }
        return $days;
    }

    # Relation
    /**
     * Get the profile record associated with the user.
     */
    public function products()
    {
        return $this->hasMany('App\Product');
    }
}
