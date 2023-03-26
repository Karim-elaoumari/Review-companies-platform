<?php

namespace App\Models;

use App\Models\User;
use App\Models\Company;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Job extends Model
{
    use HasFactory;



    public function companies()
    {
        return $this->belongsToMany(Company::class);
    }
    public function users()
    {
        return $this->belongsTo(User::class);
    }
}
