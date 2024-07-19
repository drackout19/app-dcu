<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\Dcurecap;

class Timesheet extends Model
{
    use HasFactory;

    protected $guarded = ["id"];

    public function dcurecap() {
        return $this->belongsTo(Dcurecap::class);
    }

    public function salary() {
        return $this->belongsTo(Salary::class);
    }
}
