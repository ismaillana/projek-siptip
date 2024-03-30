<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Jurnal extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $guarded = ['id'];

    /**
     * The accessors to append to the model's array form.
     *
     * @var array
     */
    protected $appends = ['file_url'];

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
     * Save file_jurnal.
     *
     * @param  $request
     * @return string
     */
    public static function saveDokumen($request)
    {   
        $filename = null;

        if ($request->file_jurnal) {
            $file = $request->file_jurnal;

            $ext = $file->getClientOriginalExtension();

            $originalName = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME);

            $filename = $originalName . '-' . date('Ymd-His') . '.' . $ext;

            $file->storeAs('public/file_jurnal/', $filename);
        }

        return $filename;
    }

    /**
     * Get the file .
     *
     * @return string
     */
    public function getFileUrlAttribute()
    {
        if ($this->file_jurnal) {
            return asset('storage/public/file_jurnal/' . $this->file_jurnal);
        }
        
        return null;
    }

    public static function deleteFile(string $id)
    {
        $jurnal = Jurnal::firstWhere('id', $id);
        if ($jurnal->file_jurnal != null) {
            $path = 'public/file_jurnal/' . $jurnal->file_jurnal;
            if (Storage::exists($path)) {
                Storage::delete('public/file_jurnal/' . $jurnal->file_jurnal);
            }
        }
    }
}
