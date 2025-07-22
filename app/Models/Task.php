<?php

declare(strict_types=1);

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @property int $id
 * @property int $user_id
 * @property string $title
 * @property Carbon $deadline
 * @property int $status
 * @property Carbon $updated_at
 * @property Carbon $created_at
 *
 * @property-read User $user
 */
class Task extends Model
{
    protected $table = 'tasks';

    /**
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'deadline' => 'datetime'
        ];
    }

    public const TITLE_INPUT_NAME = 'title';
    public const DEADLINE_INPUT_NAME = 'deadline';
    public const STATUS_INPUT_NAME = 'status';

    public const STATUS_NEW = 0;
    public const STATUS_IN_PROGRESS = 1;
    public const STATUS_DONE = 2;

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
}
