<?php

namespace Yjtec\Upload\Models;

use Illuminate\Database\Eloquent\Model;

class File extends Model
{
    //
    protected $table="file_system";
    protected $fillable = [
        'filename', 'mimetype', 'filesize', 'extension','path','url','foreign_key'
    ];
}
