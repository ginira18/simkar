<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Salary extends Model
{
    use HasFactory;

    // protected $casts = [
    //     'amount' => 'string',
    // ];

    // public function employee()
    // {
    //     return $this->hasOne(Employee::class);
    // }

    protected $fillable = [
        'id',
        'base_salary',
        'fix_allowance',
        'status',
    ];

    public function employee()
    {
        return $this->belongsTo(Employee::class, 'id', 'id');
    }
}
