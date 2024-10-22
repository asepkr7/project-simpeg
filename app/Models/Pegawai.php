<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Pegawai extends Model
{
    use HasFactory;
    protected $guarded = ['id'];
    public $timestamps = false;
    protected $table = 'pegawai';
    // protected $primaryKey = 'id_pegawai';

     public function getRouteKeyName()
    {
        return 'nip';
    }

     public function scopeFilter($query, array $fillters)
    {
         if (isset($fillters['search']) ? $fillters['search'] : false) {
        return $query->where('nama', 'like', '%'.$fillters['search'].'%')
               ->orWhere('nip', 'like', '%'.$fillters['search'].'%')
               ->orWhere('karpeg', 'like', '%'.$fillters['search'].'%')
               ->orWhere('status_kepegawaian', 'like', '%'.$fillters['search'].'%');
    }

}
public function user()
{
   return $this->hasOne(User::class);
}

public function anak()
{
    return $this->hasMany(Anak::class);
}
public function pasangan()
{
    return $this->hasMany(Pasangan::class);
}
public function ortu()
{
    return $this->hasMany(Ortu::class);
}
public function pangkat()
{
return $this->hasMany(Pangkat::class)->where('status', 1);
}
public function pendidikan()
{
    return $this->hasMany(Pendidikan::class);
}
public function cuti()
{
    return $this->hasMany(PengajuanCuti::class)->where('status', 'Diterima');;
}

public function jabatan()
{
    return $this->hasMany(Jabatan::class)->where('status', 1);
}
public function diklat()
{
    return $this->hasMany(Diklat::class);
}

public function gapok()
{
    return $this->hasMany(Gapok::class);
}
public function pensiun()
{
    return $this->hasMany(Pensiun::class);
}
public function penghargaan()
{
    return $this->hasMany(Penghargaan::class);
}
public function kgb()
{
    return $this->hasMany(KGB::class);
}
public function lampiran()
{
    return $this->hasMany(Lampiran::class);
}

}