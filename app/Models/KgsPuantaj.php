<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KgsPuantaj extends Model
{
    use HasFactory;

    public function puantajToName()
    {
        return $this->hasOne(KgsUsers::class,'kgs_id','kgs_id');
    }

}
