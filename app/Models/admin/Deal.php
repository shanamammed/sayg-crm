<?php

namespace App\Models\admin;
use App\Models\admin\Deal;
use App\Models\admin\Stage;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Deal extends Model
{
    use HasFactory, SoftDeletes;

     public function stage(){
        return $this->belongsTo(Stage::class);
    }
}
