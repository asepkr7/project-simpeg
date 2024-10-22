<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PengajuanCuti extends Model
{
    use HasFactory;
    public $table = 'pengajuancuti';
    protected $guarded = ['id'];
    public $timestamps = false;

     public function scopeFilter($query, array $fillters)
    {
         if (isset($fillters['search']) ? $fillters['search'] : false) {
        return $query->where('jenis_cuti', 'like', '%'.$fillters['search'].'%')
               ->orWhere('no_surat', 'like', '%'.$fillters['search'].'%')
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