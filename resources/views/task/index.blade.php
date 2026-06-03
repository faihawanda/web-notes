@extends('layouts.app')

@section('content')
    {{-- Header --}}
    <div class="flex items-center gap-5 mb-8">
        <h1 class="text-3xl font-bold text-gray-800 mb-2">Project Manager</h1>
    </div>

    {{-- Content --}}
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 items-start">

        <!-- To-Do -->
        <div class="bg-[#FBFCFF] border border-[#E3E8F4] rounded-[30px] p-4 w-full">
            <div class="bg-[#EEF2FF] rounded-[22px] px-5 py-4 flex items-center justify-between mb-5">
                <div class="flex items-center gap-3">
                    <div class="w-10 h-10 rounded-full bg-[#6D77FF] flex items-center justify-center text-white">
                        <i class="ri-time-line"></i>
                    </div>
                    <h2 class="font-semibold text-[28px] text-[#111827]">To-Do</h2>
                    <span
                        class="h-7 px-3 flex items-center justify-center rounded-full bg-[#DDE7FF] text-[#2F6BFF] text-sm font-medium">
                        {{ $todoTasks->count() }}
                    </span>
                </div>
                <button class="text-[#6B7280] text-xl"><i class="ri-more-2-fill"></i></button>
            </div>

            <div class="space-y-4 mb-4">
                @foreach ($todoTasks as $task)
                    @include('partials.task-card', ['task' => $task, 'deleteColor' => '#FF7C93'])
                @endforeach
            </div>

            <button onclick="openModal('todo')"
                class="w-full h-[58px] bg-[#2F6BFF] rounded-[20px] text-white text-xl font-medium hover:scale-[1.02] duration-300 flex items-center justify-center gap-2">
                <i class="ri-add-line text-2xl"></i> Add Task
            </button>
        </div>

        <!-- In Progress -->
        <div class="bg-[#FBFCFF] border border-[#E3E8F4] rounded-[30px] p-4 w-full">
            <div class="bg-[#F1EEFF] rounded-[22px] px-5 py-4 flex items-center justify-between mb-5">
                <div class="flex items-center gap-3">
                    <div class="w-10 h-10 rounded-full bg-[#8C7AE6] flex items-center justify-center text-white">
                        <i class="ri-loader-4-line"></i>
                    </div>
                    <h2 class="font-semibold text-[28px] text-[#111827]">In Progress</h2>
                    <span
                        class="h-7 px-3 flex items-center justify-center rounded-full bg-[#DDE7FF] text-[#2F6BFF] text-sm font-medium">
                        {{ $progressTasks->count() }}
                    </span>
                </div>
                <button class="text-[#6B7280] text-xl"><i class="ri-more-2-fill"></i></button>
            </div>

            <div class="space-y-4 mb-4">
                @foreach ($progressTasks as $task)
                    @include('partials.task-card', ['task' => $task, 'deleteColor' => '#8C7AE6'])
                @endforeach
            </div>

            <button onclick="openModal('in-progress')"
                class="w-full h-[58px] bg-[#8C7AE6] rounded-[20px] text-white text-xl font-medium hover:scale-[1.02] duration-300 flex items-center justify-center gap-2">
                <i class="ri-add-line text-2xl"></i> Add Task
            </button>
        </div>

        <!-- Done -->
        <div class="bg-[#FBFCFF] border border-[#E3E8F4] rounded-[30px] p-4 w-full">
            <div class="bg-[#EDF9F0] rounded-[22px] px-5 py-4 flex items-center justify-between mb-5">
                <div class="flex items-center gap-3">
                    <div class="w-10 h-10 rounded-full bg-[#43C06B] flex items-center justify-center text-white">
                        <i class="ri-check-line"></i>
                    </div>
                    <h2 class="font-semibold text-[28px] text-[#111827]">Done</h2>
                    <span
                        class="h-7 px-3 flex items-center justify-center rounded-full bg-[#DDE7FF] text-[#2F6BFF] text-sm font-medium">
                        {{ $doneTasks->count() }}
                    </span>
                </div>
                <button class="text-[#6B7280] text-xl"><i class="ri-more-2-fill"></i></button>
            </div>

            <div class="space-y-4 mb-4">
                @foreach ($doneTasks as $task)
                    @include('partials.task-card', ['task' => $task, 'deleteColor' => '#43C06B'])
                @endforeach
            </div>

            <button onclick="openModal('done')"
                class="w-full h-[58px] bg-[#43C06B] rounded-[20px] text-white text-xl font-medium hover:scale-[1.02] duration-300 flex items-center justify-center gap-2">
                <i class="ri-add-line text-2xl"></i> Add Task
            </button>
        </div>

    </div>

    {{-- MODAL FORM --}}
    <div id="taskModal"
        class="fixed inset-0 bg-black/50 z-50 flex items-center justify-center hidden opacity-0 transition-opacity duration-300">
        <div
            class="bg-white rounded-[30px] p-6 w-full max-w-md shadow-lg mx-4 transform scale-95 transition-transform duration-300">
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

                <button type="submit"
                    class="w-full h-[54px] bg-[#2F6BFF] rounded-xl text-white font-medium hover:bg-blue-600 transition duration-200 mt-2">
                    Save Task
                </button>
            </form>
        </div>
    </div>

    {{-- MODAL EDIT --}}
    <div id="editTaskModal"
        class="fixed inset-0 bg-black/50 z-50 flex items-center justify-center hidden opacity-0 transition-opacity duration-300">
        <div
            class="bg-white rounded-[30px] p-6 w-full max-w-md shadow-lg mx-4 transform scale-95 transition-transform duration-300">
            <div class="flex justify-between items-center mb-6">
                <h3 class="text-2xl font-bold text-black">Edit Task Title</h3>
                <button onclick="closeEditModal()" class="text-gray-400 hover:text-gray-600 text-2xl">
                    <i class="ri-close-line"></i>
                </button>
            </div>


            <form id="editTaskForm" method="POST" class="space-y-4">
                @csrf
                @method('PUT') <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-2">New Title</label>
                    <input type="text" name="title" id="editModalTitle" required
                        class="w-full px-4 h-[50px] border border-[#E5E8F5] rounded-xl outline-none focus:border-[#2F6BFF]">
                </div>


                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-2">Category</label>
                    <input type="text" name="category" id="editModalCategory"
                        class="w-full px-4 h-[50px] border border-[#E5E8F5] rounded-xl outline-none focus:border-[#2F6BFF]">
                </div>


                <div class="flex justify-end gap-3 mt-4">
                    <button type="button" onclick="closeEditModal()"
                        class="px-4 h-[50px] bg-gray-100 hover:bg-gray-200 rounded-xl font-medium transition duration-200">
                        Cancel
                    </button>
                    <button type="submit"
                        class="px-6 h-[50px] bg-[#2F6BFF] rounded-xl text-white font-medium hover:bg-blue-600 transition duration-200">
                        Update Task
                    </button>
                </div>
            </form>
        </div>
    </div>

    {{-- MODAL HAPUS --}}
    <div id="deleteModal" class="fixed inset-0 z-50 hidden items-center justify-center p-4 bg-black/50 backdrop-blur-sm">
        <div class="bg-white rounded-2xl shadow-xl w-full max-w-sm overflow-hidden">
            <div class="px-6 pt-6 pb-5">
                <h3 class="text-base font-bold text-gray-900 text-center mb-1">Delete Category?</h3>
            </div>
            <div class="px-6 pb-6 flex gap-2">
                {{-- Cancel Button --}}
                <button onclick="closeModal('deleteModal')"
                    class="flex-1 px-4 py-2.5 rounded-xl border border-gray-200 bg-white text-sm font-semibold text-gray-600 hover:bg-gray-50 transition-all">
                    Cancel
                </button>

                {{-- Yes, Delete Button --}}
                <form id="deleteForm" method="POST" class="flex-1">
                    @csrf
                    @method('DELETE')
                    <button type="submit"
                        class="w-full px-4 py-2.5 rounded-xl text-sm font-semibold text-white bg-red-500 hover:bg-red-600 transition-all flex items-center justify-center gap-1.5">
                        Yes, Delete
                    </button>
                </form>
            </div>


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

        function openEditModal(id, title, category) {
            const modal = document.getElementById('editTaskModal');
            const form = document.getElementById('editTaskForm');
            const titleInput = document.getElementById('editModalTitle');
            const categoryInput = document.getElementById('editModalCategory');


            titleInput.value = title;
            categoryInput.value = category;


            form.setAttribute('action', `/tasks/${id}`);




            modal.classList.remove('hidden');
            setTimeout(() => {
                modal.classList.remove('opacity-0');
                modal.querySelector('div').classList.remove('scale-95');
            }, 10);
        }
    
        function openEditModal(id, title, category) {
            const modal = document.getElementById('editTaskModal');
            const form = document.getElementById('editTaskForm');
            const titleInput = document.getElementById('editModalTitle');
            const categoryInput = document.getElementById('editModalCategory');


            titleInput.value = title;
            categoryInput.value = category;


            form.setAttribute('action', `/tasks/${id}`);




            modal.classList.remove('hidden');
            setTimeout(() => {
                modal.classList.remove('opacity-0');
                modal.querySelector('div').classList.remove('scale-95');
            }, 10);
        }

        function closeEditModal() {
            const modal = document.getElementById('editTaskModal');
            modal.classList.add('opacity-0');
            modal.querySelector('div').classList.add('scale-95');
            setTimeout(() => {
                modal.classList.add('hidden');
            }, 300);
        }
    </script>
@endsection
