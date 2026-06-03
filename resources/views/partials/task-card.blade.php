<div class="task-card bg-white rounded-[24px] border border-[#EDF0FA] shadow-sm p-5 mb-5">

    <div class="flex justify-between items-start gap-2">
        <div class="flex flex-wrap items-center gap-2">
 
            @if($task->category)
            <span class="h-7 px-3 flex items-center justify-center rounded-full bg-[#FFECEF] text-[#FF7D92] text-[12px] font-medium leading-none">
                {{ $task->category }}
            </span>
            @endif
        </div>
 
 
        <div class="flex items-center gap-2">
            <form action="{{ route('tasks.updateStatus', $task->id) }}" method="POST" class="inline">
                @csrf
                @method('PATCH')
                <select name="status" onchange="this.form.submit()" class="text-xs bg-gray-50 border border-gray-200 rounded-lg p-1 text-gray-600 outline-none cursor-pointer font-medium">
                    <option value="todo" {{ $task->status == 'todo' ? 'selected' : '' }}>To-Do</option>
                    <option value="in-progress" {{ $task->status == 'in-progress' ? 'selected' : '' }}>In Progress</option>
                    <option value="done" {{ $task->status == 'done' ? 'selected' : '' }}>Done</option>
                </select>
            </form>
 
 
            <button type="button"
                    onclick="openEditModal('{{ $task->id }}', '{{ $task->title }}', '{{ $task->category }}')"
                    class="text-[#2F6BFF] hover:scale-110 duration-200">
                <i class="ri-pencil-line text-[22px]"></i>
            </button>
        </div>
    </div>
 
 
    <h3 class="text-[#2F6BFF] text-[24px] font-semibold mt-5 mb-4 leading-tight">
       {{ $task->title }}
    </h3>
 
 
    <div class="space-y-3">
        @foreach($task->subtasks as $subtask)
        <div class="flex items-center justify-between group/item">
            <div class="flex items-center gap-2">
                <form action="{{ route('subtasks.toggle', $subtask->id) }}" method="POST">
                    @csrf
                    @method('PATCH')
                    <button type="submit" class="w-5 h-5 rounded-full border-2 border-[#2F6BFF] shrink-0 flex items-center justify-center transition duration-200 {{ $subtask->is_completed ? 'bg-[#2F6BFF]' : '' }}">
                        @if($subtask->is_completed)
                            <i class="ri-check-line text-white text-[12px]"></i>
                        @endif
                    </button>
                </form>
 
 
                <span class="text-[17px] leading-none {{ $subtask->is_completed ? 'text-[#98A2B3] line-through' : 'text-[#707991]' }}">
                    {{ $subtask->text }}
                </span>
            </div>
 
 
            {{-- Menggunakan modal hapus custom untuk subtask --}}
            <button type="button"
                    onclick="bukaModalHapusSubtask('{{ $subtask->id }}')"
                    class="text-gray-400 hover:text-red-500 opacity-0 group-hover/item:opacity-100 transition duration-200 pr-2">
                <i class="ri-close-line text-lg"></i>
            </button>
        </div>
        @endforeach
 
 
        <form action="{{ route('subtasks.store', $task->id) }}" method="POST" class="mt-4 flex items-center justify-between gap-2 border-t border-gray-100 pt-3 w-full min-w-0">
            @csrf
            <div class="flex-1 min-w-0">
                <input
                    type="text"
                    name="text"
                    required
                    placeholder="Add new item..."
                    class="w-full text-sm text-[#707991] outline-none placeholder:text-gray-300 bg-transparent break-words">
            </div>
            <button type="submit" class="text-[#2F6BFF] hover:scale-110 duration-200 shrink-0">
                <i class="ri-add-circle-line text-xl"></i>
            </button>
        </form>
    </div>
 
 
    <div class="flex justify-between items-center mt-6">
        <div class="flex items-center gap-2 text-[#98A2B3] text-sm">
            <i class="ri-calendar-line text-[18px]"></i>
            <span>{{ $task->created_at->format('d F Y') }}</span>
        </div>
 
 
        <button type="button"
                onclick="bukaModalHapusTask('{{ $task->id }}')"
                class="text-[18px] hover:scale-120 duration-200 transition"
                style="color: {{ $deleteColor }}">
            <i class="ri-delete-bin-6-line"></i>
        </button>
    </div>
 </div>
 
 
 {{-- MODAL HAPUS TASK CUSTOM --}}
 <div id="customDeleteTaskModal" class="fixed inset-0 z-50 hidden items-center justify-center p-4 bg-black/50 backdrop-blur-sm">
    <div class="bg-white rounded-2xl shadow-xl w-full max-w-[320px] overflow-hidden p-5">
        <div class="pt-2 pb-4">
            <h3 class="text-base font-bold text-gray-900 text-center">Delete Task?</h3>
        </div>
       
        <div class="flex items-center justify-center gap-3 w-full">
            {{-- Cancel Button --}}
            <button onclick="tutupModalHapusTask()" type="button"
                class="w-[110px] h-10 rounded-xl border border-gray-200 bg-white text-sm font-semibold text-gray-600 hover:bg-gray-50 transition-all flex items-center justify-center">
                Cancel
            </button>
 
 
            {{-- Yes, Delete Button --}}
            <form id="formHapusTaskSpesifik" method="POST" class="inline-block m-0 p-0">
                @csrf
                @method('DELETE')
                <button type="submit"
                    class="w-[110px] h-10 rounded-xl text-sm font-semibold text-white bg-red-500 hover:bg-red-600 transition-all flex items-center justify-center">
                    Yes, Delete
                </button>
            </form>
        </div>
    </div>
 </div>
 
 {{-- MODAL HAPUS SUBTASK CUSTOM --}}
 <div id="customDeleteSubtaskModal" class="fixed inset-0 z-50 hidden items-center justify-center p-4 bg-black/50 backdrop-blur-sm">
    <div class="bg-white rounded-2xl shadow-xl w-full max-w-[320px] overflow-hidden p-5">
        <div class="pt-2 pb-4">
            <h3 class="text-base font-bold text-gray-900 text-center">Delete Item?</h3>
        </div>
       
        <div class="flex items-center justify-center gap-3 w-full">
            {{-- Cancel Button --}}
            <button onclick="tutupModalHapusSubtask()" type="button"
                class="w-[110px] h-10 rounded-xl border border-gray-200 bg-white text-sm font-semibold text-gray-600 hover:bg-gray-50 transition-all flex items-center justify-center">
                Cancel
            </button>
 
 
            {{-- Yes, Delete Button --}}
            <form id="formHapusSubtaskSpesifik" method="POST" class="inline-block m-0 p-0">
                @csrf
                @method('DELETE')
                <button type="submit"
                    class="w-[110px] h-10 rounded-xl text-sm font-semibold text-white bg-red-500 hover:bg-red-600 transition-all flex items-center justify-center">
                    Yes, Delete
                </button>
            </form>
        </div>
    </div>
 </div>
 
 {{-- JAVASCRIPT PERSONAL UNTUK HANDLING MODAL --}}
 <script>
    // Logic Modal Hapus Task
    function bukaModalHapusTask(id) {
        const modal = document.getElementById('customDeleteTaskModal');
        if (modal) {
            modal.classList.remove('hidden');
            modal.classList.add('flex');
           
            const form = document.getElementById('formHapusTaskSpesifik');
            if (form) {
                form.action = `/tasks/${id}`;
            }
        }
    }
 
    function tutupModalHapusTask() {
        const modal = document.getElementById('customDeleteTaskModal');
        if (modal) {
            modal.classList.add('hidden');
            modal.classList.remove('flex');
        }
    }

    // Logic Modal Hapus Subtask (List Item)
    function bukaModalHapusSubtask(id) {
        const modal = document.getElementById('customDeleteSubtaskModal');
        if (modal) {
            modal.classList.remove('hidden');
            modal.classList.add('flex');
           
            const form = document.getElementById('formHapusSubtaskSpesifik');
            if (form) {
                form.action = `/subtasks/${id}`;
            }
        }
    }
 
    function tutupModalHapusSubtask() {
        const modal = document.getElementById('customDeleteSubtaskModal');
        if (modal) {
            modal.classList.add('hidden');
            modal.classList.remove('flex');
        }
    }
 </script>
 
 