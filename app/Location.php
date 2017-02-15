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

}
