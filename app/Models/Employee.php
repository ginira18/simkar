<?php

namespace App\Models;

use App\Models\Salary;
use App\Models\Department;
use App\Models\Attendance;
use App\Models\Permission;
use App\Models\SalaryHistory;
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
    public function salary()
    {
        return $this->hasOne(Salary::class, 'id', 'id');
    }
    public function salaryHistories()
    {
        return $this->hasMany(SalaryHistory::class);
    }
    public function department()
    {
        return $this->belongsTo(Department::class);
    }
    // public function salary()
    // {
    //     return $this->belongsTo(Salary::class);
    // }
    public function attendances()
    {
        return $this->hasMany(Attendance::class);
    }
    public function permissions()
    {
        return $this->hasMany(Permission::class);
    }
    public function reports()
    {
        return $this->hasMany(Report::class);
    }
}
