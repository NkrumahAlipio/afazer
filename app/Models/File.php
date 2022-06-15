<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\File as FacadesFile;

class File extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function getUrlAttribute(): string
    {
        return asset($this->path);
    }

    public function getExtensionAttribute(): string
    {
        return FacadesFile::extension($this->path);
    } 

    public function getSizeAttribute(): string
    {
        return self::formatBytes(FacadesFile::size($this->path));
    }

    public function getTypeAttribute(): string
    {
        return FacadesFile::type($this->path);
    }

    static function formatBytes($bytes, $precision = 2): string
    {
        $units = array('B', 'KB', 'MB', 'GB', 'TB');

        $bytes = max($bytes, 0);
        $pow = floor(($bytes ? log($bytes) : 0) / log(1024));
        $pow = min($pow, count($units) - 1);

        $bytes /= pow(1024, $pow);

        return round($bytes, $precision) . ' ' . $units[$pow];
    }
}
