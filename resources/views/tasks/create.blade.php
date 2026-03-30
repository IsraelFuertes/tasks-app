@extends('layouts.app')

@section('content')

<h2>Nueva Tarea</h2>




<form method="POST" action="{{ route('tasks.store') }}">
    @csrf

    
    <div>
        <label>Título *</label><br>
        <input type="text" name="title" value="{{ old('title') }}" placeholder="Título">

        @error('title')
            <p style="color:red;">{{ $message }}</p>
        @enderror
    </div>

    <br>

    
    <div>
        <label>Descripción</label><br>
        <textarea name="description">{{ old('description') }}</textarea>

        @error('description')
            <p style="color:red;">{{ $message }}</p>
        @enderror
    </div>

    <br>

    
    <div>
        <label>Estado *</label><br>
        <select name="status">
            <option value="">Seleccione</option>
            <option value="pending" {{ old('status')=='pending'?'selected':'' }}>Pendiente</option>
            <option value="in_progress" {{ old('status')=='in_progress'?'selected':'' }}>En progreso</option>
            <option value="completed" {{ old('status')=='completed'?'selected':'' }}>Completada</option>
        </select>

        @error('status')
            <p style="color:red;">{{ $message }}</p>
        @enderror
    </div>

    <br>

    
    <div>
        <label>Prioridad *</label><br>
        <select name="priority">
            <option value="">Seleccione</option>
            <option value="low" {{ old('priority')=='low'?'selected':'' }}>Baja</option>
            <option value="medium" {{ old('priority')=='medium'?'selected':'' }}>Media</option>
            <option value="high" {{ old('priority')=='high'?'selected':'' }}>Alta</option>
        </select>

        @error('priority')
            <p style="color:red;">{{ $message }}</p>
        @enderror
    </div>

    <br>

    
    <div>
        <label>Fecha límite</label><br>
        <input type="date" name="due_date" value="{{ old('due_date') }}">

        @error('due_date')
            <p style="color:red;">{{ $message }}</p>
        @enderror
    </div>

    <br>

    {{-- 🔹 EMAIL --}}
    <div>
        <label>Email asignado</label><br>
        <input type="email" name="assigned_email" value="{{ old('assigned_email') }}">

        @error('assigned_email')
            <p style="color:red;">{{ $message }}</p>
        @enderror
    </div>

    <br>

    <button type="submit">Guardar</button>

</form>

@endsection