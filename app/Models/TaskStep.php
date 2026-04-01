<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TaskStep extends Model
{
    /** @use HasFactory<\Database\Factories\TaskStepFactory> */
    use HasFactory;


    protected $fillable = [
        'task_id',
        'title',
        'description',
        'status',
        'is_completed',
        'is_current_focus',
        'estimated_duration',
        'order',
    ];

    public function task()
    {
        return $this->belongsTo(Task::class);
    }
}
