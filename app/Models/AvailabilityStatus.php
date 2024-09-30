<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AvailabilityStatus extends Model
{
    use HasFactory;

    protected $table = 'availability_status';
    protected $primaryKey = 'availability_status_id';

    protected $fillable = [
        'status_type',
    ];
}
