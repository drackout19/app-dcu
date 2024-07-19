<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\Dcurecap;
use App\Models\Salary;
// use App\Models\Timesheet;

class Manpower extends Model
{
    use HasFactory;

    protected $guarded = ["id"];

    public function dcurecap() {
        return $this->hasMany(Dcurecap::class);
    }

    public function salary() {
        return $this->hasOne(Salary::class);
    }


}
