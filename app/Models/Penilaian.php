<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Penilaian extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $guarded = ['id'];

    /**
     * Get the kaderisasi that owns the kaderisasi
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function kaderisasi()
    {
        return $this->belongsTo(Kaderisasi::class);
    }
}
