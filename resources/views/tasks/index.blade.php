<!-- resources/views/tasks/index.blade.php -->

@extends('layouts.app')

@section('content')
    <h1>Tareas</h1>

    <ul>
        @foreach($tasks as $task)
            <li>
                <a href="{{ url('/tasks', $task->id) }}">{{ $task->title }}</a>
                <form action="{{ url('/tasks', $task->id) }}" method="POST" style="display: inline;">
                    @csrf
                    @method('DELETE')
                    <button type="submit">Eliminar</button>
                </form>
            </li>
        @endforeach
    </ul>

    <h2>Agregar Nueva Tarea</h2>
    <form action="{{ url('/tasks') }}" method="POST">
        @csrf
        <label for="title">Título:</label>
        <input type="text" name="title" required>
        <label for="description">Descripción:</label>
        <textarea name="description" rows="3"></textarea>
        <button type="submit">Agregar Tarea</button>
    </form>
@endsection
