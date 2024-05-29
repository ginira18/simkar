<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{

    use HasFactory;

    protected $fillable = [
        'name', 'email', 'birth_date', 'gender', 'religion', 'phone_number', 
        'last_education', 'address', 'hire_date', 'hire_date_end', 'position', 
        'employee_type', 'bpjs'
    ];
    
    public function user()
    {
        // return $this->belongsTo(User::class, 'id');
        return $this->hasOne(User::class, 'id');
    }

}
