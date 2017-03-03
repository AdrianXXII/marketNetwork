<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Market extends Model
{
    // Determines which database table to use
    protected $table = 'markets';

    // Timestamp ausstellen
    public $timestamps = false;

    protected $fillable = array('location_id', 'name', 'start_date', 'end_date', 'available');

    public function location(){
        return $this->belongsTo('App\Location');
    }

    public function members(){
        return $this->belongsToMany('App\Member', 'market_members');
    }

    public function hasVendor($vId){
        return ! $this->members->filter(function($member) use ($vId){
            return $member->id == $vId;
        })->isEmpty();
    }
}
