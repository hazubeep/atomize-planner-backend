<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Task;
use App\Models\TaskStep;
use Illuminate\Http\Request;
use App\Services\AIService;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class TaskController extends Controller
{
    public function index()
    {
        $tasks = Task::with('taskSteps')
            ->withCount([
                'taskSteps as total_steps',
                'taskSteps as completed_steps' => function ($query) {
                    $query->where('is_completed', true);
                }
            ])
            ->where('user_id', auth()->id())
            ->get();

        return response()->json([
            'success' => true,
            'data' => $tasks
        ]);
    }

    public function atomize(Request $request, AIService $aiService)
    {
        $validated = $request->validate([
            'title' => 'required',
        ]);

        DB::beginTransaction();

        try {
            $aiResult = json_decode($aiService->generateSteps($validated['title']), true);

            $mainTitle = $aiResult['task']['title'] ?? $validated['title'];
            $mainDescription = $aiResult['task']['description'] ?? null;
            $mainCategory = $aiResult['task']['category'] ?? null;
            $mainStatus = $aiResult['task']['status'] ?? null;

            $task = Task::create([
                'user_id' => auth()->id(),
                'title' => $mainTitle,
                'description' => $mainDescription,
                'category' => strtolower($mainCategory),
                'status' => strtolower($mainStatus),
                'progress_percentage' => 0,
            ]);

            $steps = [];
            foreach ($aiResult['task_steps'] as $index => $step) {

                $newStep = TaskStep::create([
                    'task_id' => $task->id,
                    'title' => $step['title'],
                    'description' => $step['description'] ?? null,
                    'status' => 'pending',
                    'is_completed' => 0,
                    'is_current_focus' =>  0,
                    'estimated_duration' => $step['estimated_duration'] ?? 10,
                    'order' => $index,
                ]);
                $steps[] = $newStep;
            }

            DB::commit();

            $task->load('taskSteps');

            return response()->json([
                'success' => true,
                'data' => array_merge($task->toArray(), [
                    'total_steps' => count($aiResult['task_steps']),
                    'completed_steps' => 0,
                    'task_steps' => $steps
                ])
            ], 201);
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Atomize failed: ' . $e->getMessage());

            return response()->json([
                'success' => false,
                'error' => [
                    'code'    => 'AI_SERVICE_ERROR',
                    'message' => app()->isProduction()
                        ? 'AI Service is currently unavailable. Please try again later.'
                        : $e->getMessage(),
                ]
            ], 500);
        }
    }

    public function destroy($id)
    {
        $task = Task::where('user_id', auth()->id())->findOrFail($id);
        $task->delete();

        return response()->json([
            'success' => true,
            'message' => 'Task deleted successfully.'
        ]);
    }

    public function show($id, Request $request)
    {
        $task = Task::with('tasksteps')
            ->withCount([
                'taskSteps as total_steps',
                'taskSteps as completed_steps' => function ($query) {
                    $query->where('is_completed', true);
                }
            ])->where('user_id', $request->user()->id)
            ->find($id);

        if (!$task) {
            return response()->json([
                "success" => false,
                "message" => "Task not found"
            ], 404);
        }

        return response()->json([
            "success" => true,
            "data" => $task
        ]);
    }

    public function update($id, Request $request)
    {
        $task = Task::with('tasksteps')
            ->withCount([
                'taskSteps as total_steps',
                'taskSteps as completed_steps' => function ($query) {
                    $query->where('is_completed', true);
                }
            ])->where('user_id', $request->user()->id)->find($id);

        if (!$task) {
            return response()->json([
                "success" => false,
                "message" => "Task not found"
            ], 404);
        }

        $validated = $request->validate([
            'title' => 'sometimes',
            'description' => 'nullable',
            'category' => 'nullable',
            'status' => 'nullable',
        ]);

        $task->update($validated);

        return response()->json([
            "success" => true,
            "data" => $task
        ]);
    }

    // public function toggle($taskId, $stepId, Request $request)
    // {
    // $step = TaskStep::where('id', $stepId)
    //     ->whereHas('task', function ($q) use ($request, $taskId) {
    //         $q->where('id', $taskId)
    //           ->where('user_id', $request->user()->id);
    //     })
    //     ->first();

    // if (!$step) {
    //     return response()->json([
    //         "success" => false,
    //         "message" => "Step tidak ditemukan"
    //     ], 404);
    // }

    // $step->is_completed = !$step->is_completed;
    // $step->save();

    // return response()->json([
    //     "success" => true,
    //     "data" => $step
    // ]);
    // }
    //
    /* public function store(Request $request) */
    /* { */
    /*     $validated = $request->validate([ */
    /*         'title' => 'required|string|max:255', */
    /*         'description' => 'nullable|string' */
    /*     ]); */
    /**/
    /*     $task = Task::create([ */
    /*         'user_id' => $request->user()->id, */
    /*         'title' => $validated['title'], */
    /*         'description' => $validated['description'] ?? null, */
    /*         'is_completed' => false */
    /*     ]); */
    /**/
    /*     return response()->json([ */
    /*         "success" => true, */
    /*         "data" => $task */
    /*     ]); */
    /* } */
}
