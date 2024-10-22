<?php

namespace App\Models;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
// use Illuminate\Foundation\Auth\AuthenticatesUsers;

class User extends Authenticatable
{
    use HasFactory, Notifiable, HasApiTokens;
     protected $guarded = ['id'];
     public $timestamps = false;

      public function getRouteKeyName()
    {
        return 'username';
    }

     public function scopeFilter($query, array $fillters)
    {
         if (isset($fillters['search']) ? $fillters['search'] : false) {
        return $query->where('usernmae', 'like', '%'.$fillters['search'].'%')
               ->orWhere('level', 'like', '%'.$fillters['search'].'%')
              ->OrWhereHas('pegawai', function ($query) use ($fillters) {
               $query->where('nama', 'like', '%'.$fillters['search'].'%');
               });
    }
}

public function pegawai()
    {
        return $this->belongsTo(Pegawai::class);
    }
    public function getLoginDuration()
{
    $lastLogin = $this->last_login;
    $currentTime = now();
    $duration = $lastLogin->diffInMinutes($currentTime);

    return $duration;
}

}