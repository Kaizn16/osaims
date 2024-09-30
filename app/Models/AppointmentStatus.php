<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AppointmentStatus extends Model
{
    use HasFactory;

    protected $table = 'appoinment_status';
    protected $primaryKey = 'appoinment_status_id';

    protected $fillable = [
        'status_type',
    ];

}
