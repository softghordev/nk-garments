<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function personal(){
        return $this->hasOne(EmployeePersonalInformation::class);
    }

    public function educational(){
        return $this->hasOne(EmployeeEducationalTraining::class);
    }

    public function salary(){
        return $this->hasOne(EmployeeSalary::class);
    }

    public function department(){
        return $this->belongsTo(Department::class)->withDefault([
            'name' => '',
        ]);
    }
}
