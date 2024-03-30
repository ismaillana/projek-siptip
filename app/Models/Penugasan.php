<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Penugasan extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $guarded = ['id'];

    /**
     * Get all of the Jurnal for the Jurnal
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function jurnal(): HasMany
    {
        return $this->hasMany(Jurnal::class);
    }

    /**
     * Get the Kaderisasi that owns the Kaderisasi
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function kaderisasi()
    {
        return $this->belongsTo(Kaderisasi::class);
    }
}
