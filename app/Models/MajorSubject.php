<?php

namespace App\Models;

use App\Enumerations\MajorSubjectType;
use App\Enumerations\SubjectLevel;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property int $major_id
 * @property int $subject_id
 * @property string $level
 * @property string $type
 * @property ?Carbon $created_at
 * @property ?Carbon $updated_at
 */
final class MajorSubject extends Model
{
    protected $table = 'major_subject';
    protected $fillable = ['major_id', 'subject_id', 'level'];

    protected $casts = [
        'level' => SubjectLevel::class,
        'type' => MajorSubjectType::class
    ];
}
