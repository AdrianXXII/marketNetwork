<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Member extends Model
{
    // Determines which database table to use
    protected $table = 'members';

    // Timestamp ausstellen
    public $timestamps = false;

    protected $fillable = array('name', 'firstname', 'street', 'zip', 'city', 'tel', 'email', 'vendor', 'trialperiode', 'abo_start', 'abo_id');

    public function abo(){
        return $this->belongsTo('App\Abo', 'abo_id');
    }

    public function visas(){
        return $this->hasMany('App\Visa');
    }

    public function locations(){
        return $this->belongsToMany('App\Location', 'location_members');
    }

    public function markets(){
        return $this->belongsToMany('App\Market', 'market_members');
    }
}
