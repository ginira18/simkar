<?php

namespace App\Models;

use App\Models\Salary;
use App\Models\Department;
use App\Models\Attendance;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Employee extends Model
{

    use HasFactory;

    // protected $fillable = [
    //     'name', 'email', 'birth_date', 'gender', 'religion', 'phone_number', 
    //     'last_education', 'address', 'hire_date', 'hire_date_end', 'position', 
    //     'employee_type', 'bpjs'
    // ];
    protected $guarded = ['id'];
    
    public function user()
    {
        // return $this->belongsTo(User::class, 'id');
        return $this->hasOne(User::class, 'id' , 'id');
    }

    public function department()
    {
        return $this->belongsTo(Department::class);
    }
    public function salary()
    {
        return $this->belongsTo(Salary::class);
    }
    public function attendances()
    {
        return $this->hasMany(Attendance::class);
    }
    public function permissions()
    {
        return $this->hasMany(Permission::class);
    }
}
