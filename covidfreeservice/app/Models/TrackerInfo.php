<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TrackerInfo extends Model
{
    use HasFactory;

    protected $table = 'tracker_info';
    protected $fillable = ['tracker_id', 'temperature', 'health_rate'];
}
