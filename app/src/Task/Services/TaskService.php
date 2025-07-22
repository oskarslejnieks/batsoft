<?php

declare(strict_types=1);

namespace App\src\Task\Services;

use App\Models\Task;
use App\src\Task\Factories\TaskFactory;
use App\src\Task\Repositories\TaskRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;

class TaskService
{
    private TaskRepository $taskRepository;
    private TaskFactory $taskFactory;

    public function __construct(
        TaskRepository $taskRepository,
        TaskFactory $taskFactory
    ) {
        $this->taskRepository = $taskRepository;
        $this->taskFactory = $taskFactory;
    }

    /**
     * @return Collection<Task>
     */
    public function getAll(): Collection
    {
        return $this->taskRepository->getAll();
    }

    /**
     * @param int $id
     * @return Task|null
     */
    public function getById(int $id): ?Task
    {
        if(!$id) {
            return null;
        }

        return $this->taskRepository->getById($id);
    }

    /**
     * @param Request $request
     * @return Task
     */
    public function createTask(Request $request): Task
    {
        $task = $this->taskFactory->create($request);
        $task->save();

        return $task;
    }

    /**
     * @param int $id
     * @param Request $request
     * @return Task|null
     */
    public function updateTask(int $id, Request $request): ?Task
    {
        $task = $this->taskRepository->getById($id);
        if (!$task) {
            return null;
        }

        $task->title = $request->input(Task::TITLE_INPUT_NAME);
        $task->deadline = $request->input(Task::DEADLINE_INPUT_NAME);
        $task->status = (int) $request->input(Task::STATUS_INPUT_NAME, Task::STATUS_NEW);
        $task->save();

        return $task;
    }
}
