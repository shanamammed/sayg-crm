<?php

namespace App\Models\admin;
use App\Models\admin\Deal;
use App\Models\admin\Stage;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Stage extends Model
{
    use HasFactory, SoftDeletes;

    public function deals(){
        return $this->hasMany(Deal::class,'stage_id');
    }
}
