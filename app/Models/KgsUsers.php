<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class KgsUsers extends Model
{
    use HasFactory;
    use SoftDeletes;

    public $timestamps = false;
    protected $fillable = [
        'kgs_id',
        'shift',
        'name',
    ];

    public function kgsUsrToLogin()
    {
        return $this->hasOne(KgsGiris::class,'kgs_id','kgs_id')->orderBy('giris');
    }

    public function kgsUsrToLoginMultiple()
    {
        return $this->hasMany(KgsGiris::class,'kgs_id','kgs_id')->orderBy('giris');
    }

    public function kgsUsrToLogout()
    {
        return $this->hasOne(KgsCikis::class,'kgs_id','kgs_id')->orderBy('cikis');
    }

    public function kgsUsrToLogoutMultiple()
    {
        return $this->hasMany(KgsCikis::class,'kgs_id','kgs_id')->orderBy('cikis');
    }

}
