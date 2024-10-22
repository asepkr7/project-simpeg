<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KGB extends Model
{
    use HasFactory;
    protected $guarded = ['id'];
    public $timestamps = false;
    protected $table = 'kgb';


     public function scopeFilter($query, array $fillters)
    {
         if (isset($fillters['search']) ? $fillters['search'] : false) {
        return $query->Where('pejabat_sk_lama', 'like', '%'.$fillters['search'].'%')
                ->orWhere('gapok_lama', 'like', '%'.$fillters['search'].'%')
                ->orWhereHas('pegawai', function ($query) use ($fillters) {
                    $query->where('nama', 'like', '%'.$fillters['search'].'%');
                });

    }

    }

     public function pegawai()
    {
        return $this->belongsTo(Pegawai::class);
    }

}