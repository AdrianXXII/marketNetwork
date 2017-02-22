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

    public function abos(){
        $this->belongsTo('App\Abos', 'abo_id');
    }

    public function locations(){
        $this->belongsToMany('App\LocationMember', 'member_id');
    }

    public function markets(){
        $this->belongsToMany('App\MarketMember', 'member_id');
    }
}
