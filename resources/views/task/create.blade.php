@php
    use App\Models\Task;

    /** @var Task $task */
@endphp

@extends('layouts.app')

@section('title', $title)

@section('content')
    <div class="row justify-content-center">
        <div class="col-md-8 col-lg-6">
            <div class="card">

                <div class="card-header">
                    <h4>Create New Task</h4>
                </div>

                <div class="card-body">

                    @if(session('success'))
                        <div
                            class="alert alert-success alert-dismissible fade show"
                            role="alert"
                        >
                            {{ session('success') }}
                            <a href="{{ route('task.index') }}" class="alert-link">
                                See all tasks
                            </a>
                        </div>
                    @endif

                    <form method="POST" action="{{ route('task.save') }}">
                        @csrf

                        <div class="mb-3">
                            <label for="title" class="form-label">Title</label>

                            <input
                                type="text"
                                name="{{ Task::TITLE_INPUT_NAME }}"
                                class="form-control"
                                required
                            />

                        </div>

                        <div class="mb-3">
                            <label for="deadline" class="form-label">Deadline</label>

                            <input
                                type="datetime-local"
                                name="{{ Task::DEADLINE_INPUT_NAME }}"
                                class="form-control"
                                required
                            />

                        </div>

                        <div class="mb-3">
                            <label for="status" class="form-label">Status</label>

                            <select
                                name="{{ Task::STATUS_INPUT_NAME }}"
                                class="form-select"
                                required
                            >
                                <option value="{{ Task::STATUS_NEW }}">
                                    New
                                </option>

                                <option value="{{ Task::STATUS_IN_PROGRESS }}">
                                    In Progress
                                </option>

                                <option value="{{ Task::STATUS_DONE }}">
                                    Done
                                </option>

                            </select>
                        </div>

                        <div class="d-grid">
                            <button type="submit" class="btn btn-primary">
                                Save Task
                            </button>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
