<?php

declare(strict_types=1);

namespace App\src\Task\Factories;

use App\Models\Task;
use Illuminate\Http\Request;

class TaskFactory
{
    public function create(Request $request): Task
    {
        $task = new Task();
        $task->user_id = $request->user()->id;
        $task->title = $request->input(Task::TITLE_INPUT_NAME);
        $task->deadline = $request->input(Task::DEADLINE_INPUT_NAME);
        $task->status = (int) $request->input(Task::STATUS_INPUT_NAME, Task::STATUS_NEW);

        return $task;
    }
}
