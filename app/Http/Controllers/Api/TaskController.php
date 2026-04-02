<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Task;
use App\Models\TaskStep;
use Illuminate\Http\Request;
use App\Services\AIService;
use Illuminate\Support\Facades\DB;

class TaskController extends Controller
{

    public function index()
    {
        $tasks = Task::with('taskSteps')
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
            'title' => 'required|string',
        ]);

        DB::beginTransaction();

        try {
            $aiResult = json_decode($aiService->generateSteps($validated['title']), true);

            $mainTitle = $aiResult['tasks']['title'] ?? $validated['title'];
            $mainDescription = $aiResult['tasks']['description'] ?? null;

            $task = Task::create([
                'user_id' => auth()->id(),
                'title' => $mainTitle,
                'description' => $mainDescription,
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
                    'is_current_focus' => ($index === 0) ? 1 : 0,
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
                    'task_steps' => $steps
                ])
            ], 201);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json(['error' => 'Gagal sinkronisasi dengan AI'], 500);
        }
    }

    // public function atomize(Request $request, AIService $ai)
    // {
    //     $request->validate([
    //         'title' => 'required|string'
    //     ]);

    //     $task = Task::create([
    //         'user_id' => auth()->id(),
    //         'title' => $request->title,
    //         'progress_percentage' => 0
    //     ]);

    //     $steps = $ai->generateSteps($request->title);

    //     if (is_array($steps)) {
    //         return response()->json($steps, 500);
    //     }


    //     $steps = explode("\n", $steps);

    //     foreach ($steps as $step) {
    //         if (trim($step) != '') {
    //             TaskStep::create([
    //                 'task_id' => $task->id,
    //                 'title' => $step,
    //                 'estimated_duration' => 10
    //             ]);
    //         }
    //     }

    //     return response()->json([
    //         'task' => $task,
    //         'micro_steps' => $task->taskSteps
    //     ]);
    // }

    public function destroy($id)
    {

        $task = Task::where('user_id', auth()->id())->findOrFail($id);

        $task->delete();

        return [
            "message" => "Task deleted successfully"
        ];
    }
}
