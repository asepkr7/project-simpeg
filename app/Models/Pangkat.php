<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pangkat extends Model
{
    use HasFactory;
    protected $guarded = ['id'];
    public $timestamps = false;
    protected $table = 'pangkat';

    // public function getRouteKeyName()
    // {
    //     return 'nik';
    // }

     public function scopeFilter($query, array $fillters)
    {
         if (isset($fillters['search']) ? $fillters['search'] : false) {
        return $query->Where('pangkat', 'like', '%'.$fillters['search'].'%')
               ->orWhere('golongan', 'like', '%'.$fillters['search'].'%')
               ->orWhereHas('pegawai', function ($query) use ($fillters) {
                    $query->where('nama', 'like', '%'.$fillters['search'].'%');
                });
    }
    }

    protected static function booted()
    {
        static::deleting(function ($pangkat) {
            // Mengubah status pangkat jika ada data yang dihapus
            Pangkat::where('pegawai_id', $pangkat->pegawai_id)
                ->where('status', false)
                ->update(['status' => true]);
        });
    }
    public function pegawai()
    {
        return $this->belongsTo(Pegawai::class);
    }
}