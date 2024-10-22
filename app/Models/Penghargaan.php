<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Penghargaan extends Model
{
    use HasFactory;

    public $timestamps = false;
    protected $guarded = ['id'];
    protected $table = 'penghargaan';

     public function scopeFilter($query, array $fillters)
    {
         if (isset($fillters['search']) ? $fillters['search'] : false) {
        return $query->orWhere('penghargaan', 'like', '%'.$fillters['search'].'%')
               ->orWhere('tingkat_kegiatan', 'like', '%'.$fillters['search'].'%')
               ->OrWhereHas('pegawai', function ($query) use ($fillters) {
                $query->where('nama', 'like', '%'.$fillters['search'].'%');
               });
    }
    }

    public function pegawai()
    {
        return $this->belongsTo(Pegawai::class);
    }
}