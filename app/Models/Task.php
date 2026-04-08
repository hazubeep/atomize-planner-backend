<?php

namespace App\Models;

use App\Observers\TaskObserver;
use Illuminate\Database\Eloquent\Attributes\ObservedBy;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

#[ObservedBy(TaskObserver::class)]
class Task extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'title',
        'description',
        'category',
        'status',
    ];

    public function taskSteps()
    {
        return $this->hasMany(TaskStep::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
