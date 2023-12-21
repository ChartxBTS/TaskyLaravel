
<div class="p-6 lg:p-8 bg-white border-b border-gray-200">
    <div class="mr-2">
        <x-button wire:click="confirmTaskAdd">
            {{ __('Agregar Tarea') }}
        </x-button>
    </div>

    <div class="mt-4">
        <div class="flex justify-between">
            <div>
                <input type="search" placeholder="Buscar" class="shadow appearance-none border rounded-sm">
            </div>
            <!-- <div class="mr-2">
                <input wire:model.debounce.500ms="q" type="checkbox" class="mr-2 leading-tight" wire:model="active"/>Activar Solo?
            </div> -->
        </div>
        <table class="table-auto w-full">
            <thead>
                <tr>
                    <th class="px-4 py-2">
                        <div class="flex items-center">
                            <button wire:click="sortBy('id')">ID</button>
                            <x-sort-icon sortField="id" :sort-by="$sortBy" :sort-asc="$sortAsc" />

                        </div>
                    </th>
                    <th class="px-4 py-2">
                        <div class="flex items-center">
                            <button wire:click="sortBy('title')">Titulo</button>
                            <x-sort-icon sortField="title" :sort-by="$sortBy" :sort-asc="$sortAsc" />

                        </div>
                    </th>
                    <th class="px-4 py-2">
                        <div class="flex items-center">
                            <button wire:click="sortBy('description')">Descripcion</button>
                            <x-sort-icon sortField="description" :sort-by="$sortBy" :sort-asc="$sortAsc" />

                        </div>
                    </th>
                    <th class="px-4 py-2">
                        <div class="flex items-center">
                            <button wire:click="sortBy('category')">Categoria</button>
                            <x-sort-icon sortField="category" :sort-by="$sortBy" :sort-asc="$sortAsc" />

                        </div>
                    </th>
                    
                        <th class="px-4 py-2">
                            <div class="flex items-center">Estado</div>
                        </th>
                   
                    <th class="px-4 py-2">
                        <div class="flex items-center">Acciones</div>
                    </th>
                </tr>
            </thead>
            <tbody>
            @if ($tasks)
                @foreach($tasks as $task)
                <tr>
                    <td class="border px-4 py-2">{{ $task->id}}</td>
                    <td class="border px-4 py-2">{{ $task->title}}</td>
                    <td class="border px-4 py-2">{{ $task->description}}</td>
                    <td class="border px-4 py-2">{{ $task->category}}</td>
                    
                        <td class="border px-4 py-2">{{ $task->completed ? 'Yes' : 'No' }}</td>
                    
                    <td class="border px-4 py-2">
                    
                        Edit 

                        <x-danger-button wire:click="confirmTaskDeletion( {{ $task->id }})" wire:loading.attr="disabled">
                            Delete
                        </x-danger-button>
                    </td>
                </tr>
                @endforeach
                @else
                    <p>No hay tareas disponibles.</p>
                @endif

            </tbody>
        </table>

    </div>

    <div class="mt-4">
        @if ($tasks)
            {{ $tasks->links() }}
        @endif
    </div>

    <x-dialog-modal wire:model="confirmingTaskDeletion">
            <x-slot name="title">
                {{ __('Eliminar Tarea') }}
            </x-slot>

            <x-slot name="content">
                {{ __('Estas seguro que quieres eliminar la tarea?') }}
            </x-slot>

            <x-slot name="footer">
                <x-secondary-button wire:click="$set('confirmingTaskDeletion', false )" wire:loading.attr="disabled">
                    {{ __('Cancelar') }}
                </x-secondary-button>

                <x-danger-button class="ms-3" wire:click="deleteTask({{ $confirmingTaskDeletion }})" wire:loading.attr="disabled">
                    {{ __('Eliminar Tarea') }}
                </x-danger-button>
            </x-slot>
        </x-dialog-modal>


        <!-- Modal para agregar tarea -->
<x-dialog-modal wire:model="confirmingTaskAdd">
    <x-slot name="title">
        {{ __('Agregar Tarea') }}
    </x-slot>

    <x-slot name="content">
        <!-- Formulario para agregar tarea -->
        <form wire:submit.prevent="saveTask">
            <div class="col-span-6 sm:col-span-4">
                <x-label for="title" value="{{ __('Titulo de la Tarea') }}" />
                <x-input id="title" type="text" class="mt-1 block w-full" wire:model.defer="task.title" required />
                <x-input-error for="task.title" class="mt-2" />
            </div>

            <!-- Agrega los campos restantes del formulario (description, category, completed) -->

            <div class="col-span-6 sm:col-span-4">
                <x-label for="description" value="{{ __('Descripcion de la Tarea') }}" />
                <x-input id="description" type="text" class="mt-1 block w-full" wire:model.defer="task.description" required />
                <x-input-error for="task.description" class="mt-2" />
            </div>

            <div class="col-span-6 sm:col-span-4">
                <x-label for="category" value="{{ __('Categoría') }}" />
                <select id="category" name="category" class="mt-1 block w-full" wire:model.defer="task.category" required>
                    <option value="">Selecciona una categoría</option>
                    <option value="Higiene">Higiene</option>
                    <option value="Salud">Salud</option>
                    <option value="Estilo de vida">Estilo de vida</option>
                </select>
                <x-input-error for="task.category" class="mt-2" />
            </div>

            <div class="col-span-6 sm:col-span-4">
                <label class="flex items-center">
                    <input type="checkbox" wire:model.defer="task.completed" class="form-checkbox">
                    <span class="ml-2 text-sm text-gray-600">Completado</span>
                </label>
            </div>

            <!-- Agrega botones de Cancelar y Guardar -->
            <div class="mt-4">
                <x-secondary-button wire:click="$set('confirmingTaskAdd', false)">
                    {{ __('Cancelar') }}
                </x-secondary-button>

                <x-button class="ml-2" type="submit">
                    {{ __('Guardar') }}
                </x-button>
            </div>
        </form>
    </x-slot>
</x-dialog-modal>
