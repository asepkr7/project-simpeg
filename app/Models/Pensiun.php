<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pensiun extends Model
{
    use HasFactory;
     protected $table = 'pensiun';
    protected $guarded = ['id'];
    public $timestamps = false;

     public function scopeFilter($query, array $fillters)
    {
          if (isset($fillters['search']) ? $fillters['search'] : false) {
        return $query->orWhere('jenis_pensiun', 'like', '%'.$fillters['search'].'%')
               ->orWhere('cltn', 'like', '%'.$fillters['search'].'%')
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