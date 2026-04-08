<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FocusSession extends Model
{
    /** @use HasFactory<\Database\Factories\FocusSessionFactory> */
    use HasFactory;

    public function taskStep()
    {
        return $this->belongsTo(TaskStep::class);
    }

    protected $fillable = [
        'user_id',
        'task_id',
        'task_step_id',
        'duration_minutes',
        'session_notes',
        'status',
        'started_at',
        'ended_at',
        'actual_duration_minutes',
    ];
}
