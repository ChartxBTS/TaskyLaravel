@extends('layouts.app')

@section('content')
<!DOCTYPE html>
<html lang="es">
<head>
    @vite(['resources/css/app.css','resources/js/app.js'])
    <meta charset="UTF-8">
    <title>Lista de tareas</title>
    
    
</head>

    <div class="container mx-auto p-4">
        <h1 class="text-3xl font-bold mb-4">Tareas</h1>

        <ul class="list-disc pl-4">
            @foreach($tasks as $task)
                <li class="mb-2 flex items-center">
                    <a href="{{ url('/tasks', $task->id) }}" class="text-blue-500 hover:underline">{{ $task->title }}</a>
                    <form action="{{ url('/tasks', $task->id) }}" method="POST" class="ml-4">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="text-red-500 hover:underline">Eliminar</button>
                    </form>
                </li>
            @endforeach
        </ul>

        <h2 class="text-2xl font-bold mt-8 mb-4">Agregar Nueva Tarea</h2>
        <form action="{{ url('/tasks') }}" method="POST">
            @csrf
            <div class="mb-4">
                <label for="title" class="block text-sm font-bold">Título:</label>
                <input type="text" name="title" required class="w-full p-2 border border-gray-300 rounded">
            </div>
            <div class="mb-4">
                <label for="description" class="block text-sm font-bold">Descripción:</label>
                <textarea name="description" rows="3" class="w-full p-2 border border-gray-300 rounded"></textarea>
            </div>
            <button type="submit" class="bg-blue-500 text-white py-2 px-4 rounded hover:bg-blue-700">Agregar Tarea</button>
        </form>
    </div>
@endsection