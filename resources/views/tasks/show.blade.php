@extends('layouts.app')

@section('content')
    <h1>{{ $task->title }}</h1>
    <p>{{ $task->description }}</p>

    <form action="{{ url('/tasks', $task->id) }}" method="POST">
        @csrf
        @method('PUT')
        <label for="title">Título:</label>
        <input type="text" name="title" value="{{ $task->title }}" required>
        <label for="description">Descripción:</label>
        <textarea name="description" rows="3">{{ $task->description }}</textarea>
        <label for="completed">Completada:</label>
        <input type="hidden" name="completed" value="0">
        <input type="checkbox" name="completed" value="1" {{ $task->completed ? 'checked' : '' }}>
        <button type="submit">Actualizar Tarea</button>

    </form>



    <form action="{{ url('/tasks', $task->id) }}" method="POST" style="margin-top: 1rem;">
        @csrf
        @method('DELETE')
        <button type="submit">Eliminar Tarea</button>
    </form>
@endsection
