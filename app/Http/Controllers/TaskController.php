<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Inertia\Inertia;
use Mockery\Generator\TargetClassInterface;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($description)
    {
        [$tasks, $title] = self::getTasksWithTitle($description);
        return Inertia::render('Main', [
            'tasks' => $tasks,
            'title' => $title
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'title' => 'string|min:2', 'date' => 'date|nullable'
        ]);

        Task::create([
            'title' => $data['title'],
            'date' => $data['date']
        ]);

        return redirect()->back();
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Task $task)
    {
        $task->fill($request->except('steps'))->save();
        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function destroy(Task $task)
    {
        $task->delete();
        return redirect()->back();
    }

    public static function getTasksWithTitle($description): array
    {
        return match ($description) {
            'today' => [Task::whereDate('date', '=', today()->format('Y-m-d'))->get(), trans('My day')],
            'favorite' => [Task::wherefavorite(1)->with('steps')->get(), trans('Important')],
            'planned' => [Task::whereDate('date', '>', today()->format('Y-m-d'))->with('steps')->get(), trans('Planned')],
            'overdue' => [Task::whereDone(0)->whereDate('date', '<', today()->format('Y-m-d'))->with('steps')->get(), trans('Overdue')],
            'done' => [Task::whereDone(1)->with('steps')->get(), trans('Completed')]
        };
    }

    /* public static function getTasks($description): Collection
    {
        return match ($description) {
            'today' => Task::whereDate('date', '=', now()->format('Y-m-d'))->get(),
            'favorite' => Task::wherefavorite(1)->get(),
            'planned' => Task::whereDate('date', '>', now()->format('Y-m-d'))->get(),
            'overdue' => Task::whereDone(0)->whereDate('date', '<', now()->format('Y-m-d'))->get(),
            'done' => Task::whereDone(1)->get()
        };
    }*/
    public function getTasksCount($description)
    {
        $tasks = match ($description) {
            'today' => Task::whereDate('date', '=', today()->format('Y-m-d'))->count(),
            'favorite' => Task::wherefavorite(1)->count(),
            'planned' => Task::whereDate('date', '>', today()->format('Y-m-d'))->count(),
            'overdue' => Task::whereDone(0)->whereDate('date', '<', today()->format('Y-m-d'))->count(),
            'done' => Task::whereDone(1)->count()
        };

        return response()->json(['tasks' => $tasks]);
    }
}
