<?php

declare(strict_types=1);

namespace App\src\Task\Repositories;

use App\Models\Task;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;

class TaskRepository
{
    /**
     * @return Collection<Task>
     */
    public function getAll(): Collection
    {
        return Task::query()->orderBy('updated_at', 'DESC')->get();
    }

    /**
     * @param int $id
     * @return Task|Model|null
     */
    public function getById(int $id): Task|Model|null
    {
        return Task::query()
            ->where('id', $id)
            ->first();
    }
}
