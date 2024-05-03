<?php

namespace Quicktane\Core\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Carbon;
use Quicktane\Core\Base\BaseModel;

/**
 * @property int $id
 * @property string $log_name
 * @property string $description
 * @property string $subject_type
 * @property int $subject_id
 * @property string $event
 * @property string $causer_type
 * @property int $causer_id
 * @property string $properties
 * @property string $batch_uuid
 * @property ?Carbon $created_at
 * @property ?Carbon $updated_at
 */
class ActivityLog extends BaseModel
{
    use HasFactory;

    protected $guarded = [];
}
