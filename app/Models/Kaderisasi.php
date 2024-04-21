<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kaderisasi extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $guarded = ['id'];

    /**
     * Get all of the Penugasan for the Penugasan
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function penugasan(): HasMany
    {
        return $this->hasMany(Penugasan::class);
    }

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
     * Get the Karyawan that owns the Karyawan
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function manager()
    {
        return $this->belongsTo(User::class, 'id_manager');
    }

    /**
     * Get the Karyawan that owns the Karyawan
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function adminCor()
    {
        return $this->belongsTo(User::class, 'id_admin_corporate');
    }

    /**
     * Get the Karyawan that owns the Karyawan
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function karyawanJunior()
    {
        return $this->belongsTo(Karyawan::class, 'id_karyawan_junior');
    }

    /**
     * Get the Karyawan that owns the Karyawan
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function karyawanSenior()
    {
        return $this->belongsTo(Karyawan::class, 'id_karyawan_senior');
    }

    /**
     * Get all of the penilaian for the penilaian
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function penilaian(): HasMany
    {
        return $this->hasMany(Penilaian::class);
    }
}
