@php
    use App\Models\Task;
    use Carbon\Carbon;
    use Illuminate\Support\Facades\Auth;
@endphp

@extends('layouts.app')

@section('title', 'Home')

@section('content')
    <div class="text-center mb-5">
        <h1 class="display-5">Batsoft task</h1>
        <p class="lead">Newest tasks:</p>
    </div>

    <div class="row g-4">

        @php /** @var Task $task */ @endphp
        @forelse($tasks as $task)
            <div class="col-md-6 col-lg-4">
                <div class="card h-100 shadow-sm">
                    <div class="card-body d-flex flex-column">
                        <h5 class="card-title">{{ $task->title }}</h5>

                        <p class="card-text text-muted mb-3">
                            Expires: <small>{{ Carbon::parse($task->deadline) }}</small>
                        </p>

                        @php
                            $status = match($task->status) {
                                Task::STATUS_NEW => 'New',
                                Task::STATUS_IN_PROGRESS => 'In Progress',
                                Task::STATUS_DONE => 'Done'
                            };

                            $class = match($task->status) {
                                Task::STATUS_NEW => 'bg-secondary',
                                Task::STATUS_IN_PROGRESS => 'bg-warning',
                                Task::STATUS_DONE => 'bg-success'
                            };
                        @endphp

                        <span class="badge mb-3 {{ $class }}">
                            {{ $status }}
                        </span>

                        <div class="mt-auto d-flex gap-2">
                            @if(Auth::user())
                                <a
                                    href="{{ route('task.edit', ['id' => $task->id]) }}"
                                    class="btn btn-outline-secondary"
                                >
                                    Edit
                                </a>
                                <p>Created by {{ $task->user->name }}</p>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        @empty
            <div class="col-12">
                <div class="alert alert-info mt-4">
                    No tasks yet.
                </div>
            </div>
        @endforelse
    </div>
@endsection
