@extends('layouts.app')

@section('content')

<h2>Detalle de la tarea</h2>

<p><strong>Título:</strong> {{ $task->title }}</p>

<p><strong>Descripción:</strong> {{ $task->description }}</p>

@endsection