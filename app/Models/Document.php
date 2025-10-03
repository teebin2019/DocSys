<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Document extends Model
{
    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function getUrlAttribute()
    {
        return route('download_count', $this->uuid);
    }

    public function getSizeAttribute()
    {
        $size = $this->file_size ?? 0;
        // GB
        if ($size >= 1024 * 1024 * 1024) {
            return number_format($size / 1024 / 1024 / 1024, 2) . ' GB';
        }
        // MB
        elseif ($size >= 1024 * 1024) {
            return number_format($size / 1024 / 1024, 2) . ' MB';
        }
        // KB (default)
        else {
            return number_format($size / 1024, 2) . ' KB';
        }
    }


    public function getIconAttribute()
    {
        $icons = [
            'pdf' => 'bi-file-pdf text-danger',
            'image' => 'bi-file-image text-success',
            'docx' => 'bi-file-word text-primary',
            'xlsx' => 'bi-file-earmark-spreadsheet text-success',
            'pptx' => 'bi-file-powerpoint text-danger',
            'txt' => 'bi-file-text text-secondary',
            'archive' => 'bi-file-zip text-warning',
            'other' => 'bi-file-earmark text-dark',
        ];

        return $icons[$this->file_type] ?? 'bi-file-earmark text-dark';
    }

    public function getDownloadsAttribute()
    {
        return number_format($this->download_count);
    }
}
