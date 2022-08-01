<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id ID
 * @property string $name File name (with extension)
 * @property string $slug File short generated slug
 * @property string $path Relative file path in storage
 */
class File extends Model
{
    public const SLUG_LEN = 3;

    use HasFactory;

    protected $fillable = ['name', 'slug', 'path'];
}
