<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JurnalFinal extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $guarded = ['id'];

    /**
     * Get the Penugasan that owns the Penugasan
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function penugasan()
    {
        return $this->belongsTo(Penugasan::class);
    }

    /**
     * Get the Jurnal that owns the Jurnal
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function jurnal()
    {
        return $this->belongsTo(Jurnal::class);
    }
}
