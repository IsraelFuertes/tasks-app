<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;
use App\Http\Requests\StoreTaskRequest;
use App\Http\Requests\UpdateTaskRequest;

class TaskController extends Controller
{
    public function index(): View
    {
        $tasks = Task::latest()->paginate(10);
        return view('tasks.index', compact('tasks'));
    }

    public function create(): View
    {
        return view('tasks.create');
    }

    public function store(StoreTaskRequest $request): RedirectResponse
    {
        $validated = $request->validated();

        $validated['user_id'] = 1;

        $task = Task::create($validated);

        return redirect()
            ->route('tasks.show', $task)
            ->with('success', 'Tarea creada exitosamente.');
    }

    public function show(Task $task): View
    {
        return view('tasks.show', compact('task'));
    }

    public function edit(Task $task): View
    {
        return view('tasks.edit', compact('task'));
    }

    public function update(UpdateTaskRequest $request, Task $task): RedirectResponse
    {
        $validated = $request->validated();

        $task->update($validated);

        return redirect()
            ->route('tasks.show', $task)
            ->with('success', 'Tarea actualizada correctamente.');
    }

    public function destroy(Task $task): RedirectResponse
    {
        $task->delete();

        return redirect()
            ->route('tasks.index')
            ->with('success', 'Tarea eliminada.');
    }
}