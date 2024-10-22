<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Jabatan extends Model
{
    use HasFactory;


    protected $guarded = ['id'];
    public $timestamps = false;
    protected $table = 'jabatan';


     public function scopeFilter($query, array $fillters)
    {
         if (isset($fillters['search']) ? $fillters['search'] : false) {
        return $query->Where('jabatan', 'like', '%'.$fillters['search'].'%')
                ->orWhere('jenis_jabatan', 'like', '%'.$fillters['search'].'%')
                ->orWhereHas('pegawai', function ($query) use ($fillters) {
                    $query->where('nama', 'like', '%'.$fillters['search'].'%');
                });

    }

    }

    protected static function booted()
    {
        static::deleting(function ($jabatan) {
            // Mengubah status jabatan jika ada data yang dihapus
            Jabatan::where('pegawai_id', $jabatan->pegawai_id)
                ->where('status', false)
                ->update(['status' => true]);
        });
    }
    public function pegawai()
    {
        return $this->belongsTo(Pegawai::class);
    }
}