<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Instructor extends Model
{
    //

    use SoftDeletes;

    protected $guarded = ['id'];

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function instructor_course()
    {
        return $this->hasMany(InstructorCourse::class);
    }

    public function courses()
    {
        return $this->hasManyThrough(
            Course::class,       // Model tujuan (Course)
            InstructorCourse::class, // Model perantara (InstructorCourse)
            'instructor_id',     // Foreign key di tabel InstructorCourse (menghubungkan ke Instructor)
            'id',                 // Primary key di tabel Course (menghubungkan ke Course)
            'id',                 // Foreign key di tabel Instructor (menghubungkan ke Instructor)
            'course_id'          // Foreign key di tabel InstructorCourse (menghubungkan ke Course)
        );
    }

    public function educations(){
// Suggested code may be subject to a license. Learn more: ~LicenseLog:2174071803.
        return $this->hasMany(Education::class);
    }
}
