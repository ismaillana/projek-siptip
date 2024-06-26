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
    protected $appends = ['file_url','file_revisi_url','file_revisi_manager_url'];

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
     * Save file_jurnal.
     *
     * @param  $request
     * @return string
     */
    public static function saveDokumenRevisi($request)
    {   
        $filename = null;

        if ($request->file_revisi) {
            $file = $request->file_revisi;

            $ext = $file->getClientOriginalExtension();

            $originalName = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME);

            $filename = $originalName . '-' . date('Ymd-His') . '.' . $ext;

            $file->storeAs('public/file_revisi/', $filename);
        }

        return $filename;
    }

    /**
     * Save file_jurnal.
     *
     * @param  $request
     * @return string
     */
    public static function saveDokumenRevisiManager($request)
    {   
        $filename = null;

        if ($request->file_revisi_manager) {
            $file = $request->file_revisi_manager;

            $ext = $file->getClientOriginalExtension();

            $originalName = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME);

            $filename = $originalName . '-' . date('Ymd-His') . '.' . $ext;

            $file->storeAs('public/file_revisi_manager/', $filename);
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
            return asset('storage/file_jurnal/' . $this->file_jurnal);
        }
        
        return null;
    }

    /**
     * Get the file .
     *
     * @return string
     */
    public function getFileRevisiUrlAttribute()
    {
        if ($this->file_revisi) {
            return asset('storage/file_revisi/' . $this->file_revisi);
        }
        
        return null;
    }

    /**
     * Get the file .
     *
     * @return string
     */
    public function getFileRevisiManagerUrlAttribute()
    {
        if ($this->file_revisi_manager) {
            return asset('storage/file_revisi_manager/' . $this->file_revisi_manager);
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

    public static function deleteFileRevisi(string $id)
    {
        $jurnal = Jurnal::firstWhere('id', $id);
        if ($jurnal->file_revisi != null) {
            $path = 'public/file_revisi/' . $jurnal->file_revisi;
            if (Storage::exists($path)) {
                Storage::delete('public/file_revisi/' . $jurnal->file_revisi);
            }
        }
    }

    public static function deleteFileRevisiManager(string $id)
    {
        $jurnal = Jurnal::firstWhere('id', $id);
        if ($jurnal->file_revisi_manager != null) {
            $path = 'public/file_revisi_manager/' . $jurnal->file_revisi_manager;
            if (Storage::exists($path)) {
                Storage::delete('public/file_revisi_manager/' . $jurnal->file_revisi_manager);
            }
        }
    }
}
