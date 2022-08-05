<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

/**
 * @property int $id ID
 * @property string $name File name (with extension)
 * @property string $slug File short generated slug
 * @property string $path Relative file path in storage
 * @property Carbon $delete_at When file will be deleted
 */
class File extends Model
{
    use HasFactory;

    public const SLUG_LEN = 3;

    protected $fillable = ['name', 'slug', 'path', 'delete_at'];

    protected $casts = [
        'delete_at' => 'datetime',
    ];
}
