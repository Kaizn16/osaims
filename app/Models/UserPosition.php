<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserPosition extends Model
{
    use HasFactory;

    protected $table = 'positions';
    protected $primaryKey = 'position_id';

    protected $fillable = [
      'position_type',  
    ];

}
