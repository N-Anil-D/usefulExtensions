<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KgsUsers extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $fillable = [
        'kgs_id',
        'shift',
        'name',
    ];
}
