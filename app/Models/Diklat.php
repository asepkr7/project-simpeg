<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Diklat extends Model
{
    use HasFactory;
    protected $guarded = ['id'];
    public $timestamps = false;
    protected $table = 'diklat';

     public function scopeFilter($query, array $fillters)
    {
         if (isset($fillters['search']) ? $fillters['search'] : false) {
        return $query->Where('diklat', 'like', '%'.$fillters['search'].'%')
               ->orWhere('penyelenggara', 'like', '%'.$fillters['search'].'%')
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