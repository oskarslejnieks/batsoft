<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\src\Task\Services\TaskService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class TaskController
{
    private TaskService $taskService;

    public function __construct(
        TaskService $taskService
    ) {
        $this->taskService = $taskService;
    }

    /**
     * @return Response
     */
    public function index(): Response
    {
        return response()->view('home.index', [
            'title' => 'All Tasks',
            'tasks' => $this->taskService->getAll()
        ]);
    }

    /**
     * @return Response
     */
    public function create(): Response
    {
        return response()->view('task.create', [
            'title' => 'Create New Task'
        ]);
    }

    /**
     * @param int $id
     * @return Response
     */
    public function edit(int $id): Response
    {
        $task = $this->taskService->getById($id);

        return response()->view('task.edit', [
            'title' => 'Edit Task',
            'task' => $task
        ]);
    }

    /**
     * @param Request $request
     * @return RedirectResponse
     */
    public function save(Request $request): RedirectResponse
    {
        $task = $this->taskService->createTask($request);

        return redirect()
            ->route('task.create')
            ->with('success', "Task “{$task->title}” created.");
    }

    /**
     * @param Request $request
     * @param int $id
     * @return RedirectResponse
     */
    public function update(Request $request, int $id): RedirectResponse
    {
        $task = $this->taskService->updateTask($id, $request);
        if (!$task) {
            abort(404);
        }

        return redirect()
            ->route('task.edit', ['id' => $task->id])
            ->with('success', "Task “{$task->title}” updated.");
    }
}
