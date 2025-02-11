<?php

namespace App\Models;

use App\Enumerations\SubjectType;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property string $name
 * @property string $type
 * @property ?Carbon $created_at
 * @property ?Carbon $updated_at
 */
final class Subject extends Model
{
    protected $table = 'subject';
    protected $fillable = ['name', 'type'];

    protected $casts = [
        'type' => SubjectType::class
    ];
}
