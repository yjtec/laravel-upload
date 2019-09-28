<?php

namespace Yjtec\Upload\Models;

use Illuminate\Database\Eloquent\Model;

class File extends Model
{
    //
    protected $table    = "file_system_v2";
    protected $fillable = [
        'filename', 'mimetype', 'filesize', 'extension', 'path', 'url', 'foreign_key', 'type',
    ];

    public function getUrlAttribute()
    {
        $path = $this->attributes['path'];
        return \Storage::url($path);
    }
    public function setFileAttribute($file)
    {
        $this->attributes['filename']  = $file->getClientOriginalName();
        $this->attributes['mimetype']  = $file->getClientMimeType();
        $this->attributes['filesize']  = $file->getClientSize();
        $this->attributes['extension'] = $file->guessClientExtension();
    }

    public function setPathAttribute($path)
    {
        $this->attributes['key'] = md5($path);
        $this->attributes['path'] = $path;
    }
}
