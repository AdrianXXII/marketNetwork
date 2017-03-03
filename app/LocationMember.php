<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class LocationMember extends Model
{
    // Determines which database table to use
    protected $table = 'location_members';

    // Timestamp ausstellen
    public $timestamps = false;

    protected $primaryKey = array('location_id', 'member_id');

    protected $fillable = array('location_id', 'member_id');
}
