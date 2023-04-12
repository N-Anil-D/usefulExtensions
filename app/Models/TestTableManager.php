<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TestTableManager extends Model
{
    use HasFactory;
    protected $table = "test";

}
