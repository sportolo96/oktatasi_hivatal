<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property string $name
 * @property int $university_id
 * @property ?Carbon $created_at
 * @property ?Carbon $updated_at
 */
final class Institution extends Model
{
    protected $table = 'institution';
    protected $fillable = ['name', 'university_id'];
}
