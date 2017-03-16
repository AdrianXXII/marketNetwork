<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Location extends Model
{
    // Determines which database table to use
    protected $table = 'locations';

    // Timestamp ausstellen
    public $timestamps = false;

    protected $fillable = array('name', 'street', 'zip', 'city', 'member_max');

    public function markets(){
        return $this->hasMany('App\Market')->orderBy('start_date', 'asc');
    }

    public function members(){
        return $this->belongsToMany('App\Member', 'location_members');
    }

}
