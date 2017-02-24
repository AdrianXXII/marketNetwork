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
}
