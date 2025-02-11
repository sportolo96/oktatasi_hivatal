<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property string $name
 * @property int $institution_id
 * @property ?Carbon $created_at
 * @property ?Carbon $updated_at
 */
final class Major extends Model
{
    protected $table = 'major';
    protected $fillable = ['name', 'institution_id'];
}
