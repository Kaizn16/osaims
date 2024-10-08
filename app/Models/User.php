<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
class User extends Authenticatable
{
    use HasFactory;
    use Notifiable;

    protected $table = 'users';
    protected $primaryKey = 'user_id';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'username',
        'student_id',
        'fullname',
        'department_id',
        'course_id',
        'year_level',
        'age',
        'sex',
        'role_id',
        'position_id',
        'availability_status_id',
        'email',
        'contact_no',
        'password',
        'is_deleted',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }


    public function department()
    {
        return $this->belongsTo(Departments::class, 'department_id', 'role_id');
    }

    public function course()
    {
        return $this->belongsTo(Courses::class, 'course_id', 'course_id');
    }

    public function role()
    {
        return $this->belongsTo(Role::class, 'role_id', 'role_id');
    }

    public function position()
    {
        return $this->belongsTo(UserPosition::class, 'position_id', 'position_id');
    }

    public function availability()
    {
        return $this->belongsTo(AvailabilityStatus::class, 'availability_status_id', 'availability_status_id');
    }

}
