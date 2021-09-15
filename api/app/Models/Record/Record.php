<?php

namespace App\Models\Record;

use App\Models\Tag\Tag;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @property int id
 * @property string type
 * @property int user_id
 * @property float amount
 * @property string desc
 * @property Carbon created_at
 * @property Carbon updated_at
 */
class Record extends Model
{
    use HasFactory;

    protected $table = 'records';

    public function tags()
    {
        return $this->belongsToMany(
            Tag::class,
            'record_tag_relations',
            'record_id',
            'tag_id'
        );
    }
}
