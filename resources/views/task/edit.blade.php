@php
    use App\Models\Task;use Carbon\Carbon;
@endphp

@extends('layouts.app')

@section('title', $title)

@section('content')
    <div class="row justify-content-center">
        <div class="col-md-8 col-lg-6">
            <div class="card">
                <div class="card-header">
                    <h4>Edit Task</h4>
                </div>

                <div class="card-body">

                    @if(session('success'))
                        <div class="alert alert-success">{{ session('success') }}</div>
                    @endif

                    <form
                        method="POST"
                        action="{{ route('task.update', ['id' => $task->id]) }}"
                    >
                        @csrf

                        <div class="mb-3">
                            <label for="title" class="form-label">Title</label>

                            <input
                                type="text"
                                name="{{ Task::TITLE_INPUT_NAME }}"
                                class="form-control"
                                value="{{ $task->title }}"
                                required
                            />
                        </div>

                        <div class="mb-3">
                            <label for="deadline" class="form-label">Deadline</label>

                            <input
                                type="datetime-local"
                                name="{{ Task::DEADLINE_INPUT_NAME }}"
                                class="form-control"
                                value="{{ old(
                                    Task::DEADLINE_INPUT_NAME,
                                    Carbon::parse($task->deadline)->format('Y-m-d\TH:i')
                                ) }}"
                                required
                            />
                        </div>

                        <div class="mb-3">
                            <label for="status" class="form-label">Status</label>

                            <select
                                id="status"
                                name="{{ Task::STATUS_INPUT_NAME }}"
                                class="form-select"
                            >
                                <option
                                    value="{{ Task::STATUS_NEW }}"
                                    {{ old(Task::STATUS_INPUT_NAME, $task->status) === Task::STATUS_NEW ? 'selected' : '' }}
                                >New
                                </option>
                                <option
                                    value="{{ Task::STATUS_IN_PROGRESS }}"
                                    {{ old(Task::STATUS_INPUT_NAME, $task->status) === Task::STATUS_IN_PROGRESS ? 'selected' : '' }}
                                >In Progress
                                </option>
                                <option
                                    value="{{ Task::STATUS_DONE }}"
                                    {{ old(Task::STATUS_INPUT_NAME, $task->status) === Task::STATUS_DONE ? 'selected' : '' }}
                                >Done
                                </option>
                            </select>
                        </div>

                        <div class="d-grid">
                            <button type="submit" class="btn btn-primary">
                                Update Task
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
