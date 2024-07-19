<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Salary extends Model
{
    use HasFactory;

    protected $guarded = ["id"];

    public function manpower() {
        return $this->belongsTo(Manpower::class);
    }

    public function timesheet() {
        return $this->hasMany(Timesheet::class);
    }
}
