<?php

declare(strict_types=1);

namespace App\Http\Controllers\Api;

use App\src\Task\Services\TaskService;
use Illuminate\Http\JsonResponse;

class TaskController
{
    private TaskService $taskService;

    public function __construct(
        TaskService $taskService
    ) {
        $this->taskService = $taskService;
    }

    /**
     * @return JsonResponse
     */
    public function index(): JsonResponse
    {
        $tasks = $this->taskService->getAll();

        return response()->json([
            'tasks' => $tasks,
        ]);
    }
}
