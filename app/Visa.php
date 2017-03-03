<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Visa extends Model
{
    // Determines which database table to use
    protected $table = 'visas';

    // Timestamp ausstellen
    public $timestamps = false;

    protected $fillable = array('title', 'describe ', 'approved', 'member_id');

    public function member(){
        return $this->belongsTo('App\Member', 'member_id');
    }
}
