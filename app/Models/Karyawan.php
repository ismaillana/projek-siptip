<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Karyawan extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $guarded = ['id'];

    /**
     * Get the user that owns the User
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get all of the Kaderisasi for the Kaderisasi
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function kaderisasiJunior()
    {
        return $this->hasMany(Kaderisasi::class, 'id_karyawan_junior');
    }

    /**
     * Get all of the Kaderisasi for the Kaderisasi
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function kaderisasiSenior()
    {
        return $this->hasMany(Kaderisasi::class, 'id_karyawan_senior');
    }
}
