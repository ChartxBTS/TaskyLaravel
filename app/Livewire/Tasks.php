<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Task;
use Livewire\WithPagination;

class Tasks extends Component
{
    use WithPagination;

    public $active;
    public $q;
    public $sortBy = 'id';
    public $sortAsc = true;
    public $tasks;
    public $task;
    public $confirmingTaskDeletion = false;
    public $confirmingTaskAdd = false;


    protected $queryStrings = [
        'active' => ['except' => false],
        'q' => ['except' => ''],
        'sortBy' => ['except' => 'id'],
        'sortAsc' => ['except' => true],

    ];
    protected $rules = [
        'task.title' => 'required|string|min:4',
        'task.description' => 'required|string|min:4',
        'task.category' => 'required|string|min:4',
        'task.completed' => 'boolean',

    ];
    public function mount()
    {
        $this->task = [
            'title' => '',
            'description' => '',
            'category' => '',
            'completed' => false,
        ];
    }

    public function render()
{
    $tasks = Task::where('id', auth()->user()->id);

    return view('livewire.tasks', [
        'tasks' => $tasks,
    ]);
}

    public function updatingActive()
    {
        $this->resetPage();
    }

    public function updatingQ()
    {
        $this->resetPage();
    }

    public function sortBy ( $field)
    {
        if( $field == $this->sortBy) {
            $this->sortAsc = !$this->sortAsc;
        }
        $this->sortBy = $field;
    }

    public function confirmTaskDeletion( $id)
    {
        // $task->delete();
        $this->confirmingTaskDeletion = $id;
    }

    public function deleteTask( Task $task)
    {
        $task->delete();
        $this->confirmingTaskDeletion = false;

    }

    public function confirmTaskAdd()
    {
        $this->confirmingTaskAdd = true;
    }

    public function confirmTaskEdit(Task $task)
    {
        $this ->task = $task;
        $this->confirmingTaskAdd = true;
    }

    public function saveTask()
    {
        $this->validate();

        auth()->user()->tasks()->create([
            'title' => $this->task['title'],
            'description' => $this->task['description'],
            'category' => $this->task['category'],
            'completed' => $this->task['completed'] ?? 0,
        ]);

        $this->confirmingTaskAdd = false;
        $this->mount(); // Reinicia el estado de la tarea después de guardar
    }
}
