<?php

namespace App\Models\Tag;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @property int id
 * @property string name
 * @property string type
 * @property boolean is_base
 * @property int|null parent_id
 */
class Tag extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $table = 'tags';

    protected $casts = [
        'is_base' => 'boolean'
    ];

    public function tags()
    {
        return $this->hasMany(Tag::class, 'parent_id', 'id');
    }

    public function childrenTags()
    {
        return $this->hasMany(Tag::class, 'parent_id', 'id')
            ->with('tags');
    }
}

