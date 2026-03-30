@extends('layouts.app')

@section('content')

<h2>Lista de tareas</h2>

<a href="{{ route('tasks.create') }}">Nueva tarea</a>

<ul>
    @forelse($tasks as $task)
        <li>
            <strong>{{ $task->title }}</strong><br>
            {{ $task->description }}
        </li>
    @empty
        <li>No hay tareas</li>
    @endforelse
</ul>

@endsection