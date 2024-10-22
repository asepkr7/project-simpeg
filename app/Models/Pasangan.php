<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pasangan extends Model
{
    use HasFactory;
    protected $guarded = ['id'];
    public $timestamps = false;
    protected $table = 'pasangan';

    public function getRouteKeyName()
    {
        return 'nik';
    }

     public function scopeFilter($query, array $fillters)
    {
         if (isset($fillters['search']) ? $fillters['search'] : false) {
        return $query->where('nama', 'like', '%'.$fillters['search'].'%')
               ->orWhere('nik', 'like', '%'.$fillters['search'].'%')
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