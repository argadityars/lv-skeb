<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Profile extends Model
{
    protected $fillable = ['user_id', 'province_id', 'city_id', 'address', 'date', 'month', 'year', 'phone', 'avatar', 'banner'];

    # Getter
    public function getProvince() {
        $this->province_id = DB::table('provinces')->where('id', $this->province_id)->first();
        return $this->province_id;
    }

    public function getCity() {
        $this->city_id = DB::table('regencies')->where('id', $this->city_id)->first();
        return $this->city_id;
    }

    public function getDateOfBirth(){
        $dob = Carbon::createFromDate($this->year, $this->month, $this->date);
        return $dob->formatLocalized('%d %B %Y');
    }
    
    # Utility
    public function getDateList() {
    	for ($i=1; $i < 32; $i++) { 
    		$date[$i] = $i;
    	}
    	return $date;
    }

    public function getMonthList()
    {
        for($i = 1; $i <= 12; $i++){
            $month[$i] = date('F', mktime(0, 0, 0, $i, 1));
        }
        return $month;
    }

    public function getYearList()
    {
        $thisYear = date('Y', time());
        for($i = $thisYear-76; $i <= $thisYear-14; $i++){
            $year[$i] = $i;
        }
        return $year;
    }
}
