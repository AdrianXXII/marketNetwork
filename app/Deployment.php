<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Deployment extends Model
{
    // Determines which database table to use
    protected $table = 'deployments';

    // Timestamp ausstellen
    public $timestamps = false;

    protected $fillable = array('title', 'description', 'deployment_date', 'duration', 'cost');

}
