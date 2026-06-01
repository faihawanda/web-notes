@extends('layouts.app')

@section('content')

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 items-start">

        <!-- Kolom To-Do -->
        <div class="bg-[#FBFCFF] border border-[#E3E8F4] rounded-[30px] p-4 w-full">
            <div class="bg-[#EEF2FF] rounded-[22px] px-5 py-4 flex items-center justify-between mb-5">
                <div class="flex items-center gap-3">
                    <div class="w-10 h-10 rounded-full bg-[#6D77FF] flex items-center justify-center text-white">
                        <i class="ri-time-line"></i>
                    </div>
                    <h2 class="font-semibold text-[28px] text-[#111827]">To-Do</h2>
                    <span class="h-7 px-3 flex items-center justify-center rounded-full bg-[#DDE7FF] text-[#2F6BFF] text-sm font-medium">
                        {{ $todoTasks->count() }}
                    </span>
                </div>
                <button class="text-[#6B7280] text-xl"><i class="ri-more-2-fill"></i></button>
            </div>

            <div class="space-y-4 mb-4">
                @foreach($todoTasks as $task)
                    @include('partials.task-card', ['task' => $task, 'deleteColor' => '#FF7C93'])
                @endforeach
            </div>

            <button onclick="openModal('todo')" class="w-full h-[58px] bg-[#2F6BFF] rounded-[20px] text-white text-xl font-medium hover:scale-[1.02] duration-300 flex items-center justify-center gap-2">
                <i class="ri-add-line text-2xl"></i> Add Task
            </button>
        </div>

        <!-- Kolom In Progress -->
        <div class="bg-[#FBFCFF] border border-[#E3E8F4] rounded-[30px] p-4 w-full">
            <div class="bg-[#F1EEFF] rounded-[22px] px-5 py-4 flex items-center justify-between mb-5">
                <div class="flex items-center gap-3">
                    <div class="w-10 h-10 rounded-full bg-[#8C7AE6] flex items-center justify-center text-white">
                        <i class="ri-loader-4-line"></i>
                    </div>
                    <h2 class="font-semibold text-[28px] text-[#111827]">In Progress</h2>
                    <span class="h-7 px-3 flex items-center justify-center rounded-full bg-[#DDE7FF] text-[#2F6BFF] text-sm font-medium">
                        {{ $progressTasks->count() }}
                    </span>
                </div>
                <button class="text-[#6B7280] text-xl"><i class="ri-more-2-fill"></i></button>
            </div>

            <div class="space-y-4 mb-4">
                @foreach($progressTasks as $task)
                    @include('partials.task-card', ['task' => $task, 'deleteColor' => '#8C7AE6'])
                @endforeach
            </div>

            <button onclick="openModal('in-progress')" class="w-full h-[58px] bg-[#8C7AE6] rounded-[20px] text-white text-xl font-medium hover:scale-[1.02] duration-300 flex items-center justify-center gap-2">
                <i class="ri-add-line text-2xl"></i> Add Task
            </button>
        </div>

        <!-- Kolom Done -->
        <div class="bg-[#FBFCFF] border border-[#E3E8F4] rounded-[30px] p-4 w-full">
            <div class="bg-[#EDF9F0] rounded-[22px] px-5 py-4 flex items-center justify-between mb-5">
                <div class="flex items-center gap-3">
                    <div class="w-10 h-10 rounded-full bg-[#43C06B] flex items-center justify-center text-white">
                        <i class="ri-check-line"></i>
                    </div>
                    <h2 class="font-semibold text-[28px] text-[#111827]">Done</h2>
                    <span class="h-7 px-3 flex items-center justify-center rounded-full bg-[#DDE7FF] text-[#2F6BFF] text-sm font-medium">
                        {{ $doneTasks->count() }}
                    </span>
                </div>
                <button class="text-[#6B7280] text-xl"><i class="ri-more-2-fill"></i></button>
            </div>

            <div class="space-y-4 mb-4">
                @foreach($doneTasks as $task)
                    @include('partials.task-card', ['task' => $task, 'deleteColor' => '#43C06B'])
                @endforeach
            </div>

            <button onclick="openModal('done')" class="w-full h-[58px] bg-[#43C06B] rounded-[20px] text-white text-xl font-medium hover:scale-[1.02] duration-300 flex items-center justify-center gap-2">
                <i class="ri-add-line text-2xl"></i> Add Task
            </button>
        </div>

    </div>
</div>

{{-- Modal Form --}}
<div id="taskModal" class="fixed inset-0 bg-black/50 z-50 flex items-center justify-center hidden opacity-0 transition-opacity duration-300">
    <div class="bg-white rounded-[30px] p-6 w-full max-w-md shadow-lg mx-4 transform scale-95 transition-transform duration-300">
        <div class="flex justify-between items-center mb-6">
            <h3 class="text-2xl font-bold text-black">Create New Task</h3>
            <button onclick="closeModal()" class="text-gray-400 hover:text-gray-600 text-2xl">
                <i class="ri-close-line"></i>
            </button>
        </div>

        <form action="{{ route('tasks.store') }}" method="POST" class="space-y-4">
            @csrf
            <input type="hidden" name="status" id="modalTaskStatus" value="todo">

            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-2">Task Title</label>
                <input type="text" name="title" required placeholder="Example: Design the new dashboard layout" 
                       class="w-full px-4 h-[50px] border border-[#E5E8F5] rounded-xl outline-none focus:border-[#2F6BFF]">
            </div>

            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-2">Category</label>
                <input type="text" name="category" placeholder="Example: Frontend, Backend, UI Design" 
                       class="w-full px-4 h-[50px] border border-[#E5E8F5] rounded-xl outline-none focus:border-[#2F6BFF]">
            </div>

            <button type="submit" class="w-full h-[54px] bg-[#2F6BFF] rounded-xl text-white font-medium hover:bg-blue-600 transition duration-200 mt-2">
                Save Task
            </button>
        </form>
    </div>
</div>

<script>
    function openModal(status) {
        const modal = document.getElementById('taskModal');
        const statusInput = document.getElementById('modalTaskStatus');
        
        statusInput.value = status; 
        modal.classList.remove('hidden');
        setTimeout(() => {
            modal.classList.remove('opacity-0');
            modal.querySelector('div').classList.remove('scale-95');
        }, 10);
    }

    function closeModal() {
        const modal = document.getElementById('taskModal');
        modal.classList.add('opacity-0');
        modal.querySelector('div').classList.add('scale-95');
        setTimeout(() => {
            modal.classList.add('hidden');
        }, 300);
    }
</script>
@endsection