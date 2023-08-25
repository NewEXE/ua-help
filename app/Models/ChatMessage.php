<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id ID
 * @property string $content Chat message content
 * @property string $created_by_ip Created by IP
 */
class ChatMessage extends Model
{
    protected $fillable = ['content', 'created_by_ip'];
}
