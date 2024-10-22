<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Gapok extends Model
{
    use HasFactory;
     protected $guarded = ['id'];
    public $timestamps = false;
    protected $table = 'gapok';

     public function scopeFilter($query, array $fillters)
    {
         if (isset($fillters['search']) ? $fillters['search'] : false) {
        return $query->orWhere('jumlah_gapok', 'like', '%'.$fillters['search'].'%')
               ->orWhere('pejabat_sk', 'like', '%'.$fillters['search'].'%')
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