<div class="bg-white rounded-[24px] border border-[#EDF0FA] shadow-sm p-5 mb-5">

    <div class="flex justify-between items-start">
        <div class="flex items-center gap-2">
            <span class="h-7 px-3 flex items-center justify-center rounded-full bg-[#EAF2FF] text-[#2F6BFF] text-[12px] font-medium leading-none">
                High
            </span>

            @if($task->category)
            <span class="h-7 px-3 flex items-center justify-center rounded-full bg-[#FFECEF] text-[#FF7D92] text-[12px] font-medium leading-none">
                {{ $task->category }}
            </span>
            @endif
        </div>

        <button class="text-[#2F6BFF] text-xl hover:scale-110 duration-200">
            <i class="ri-edit-line"></i>
        </button>
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

            <form action="{{ route('subtasks.destroy', $subtask->id) }}" method="POST" onsubmit="return confirm('Hapus item ini?')">
                @csrf
                @method('DELETE')
                <button type="submit" class="text-gray-400 hover:text-red-500 opacity-0 group-hover/item:opacity-100 transition duration-200 pr-2">
                    <i class="ri-close-line text-lg"></i>
                </button>
            </form>
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

        <form action="{{ route('tasks.destroy', $task->id) }}" method="POST" onsubmit="return confirm('Yakin mau hapus project ini beserta seluruh list di dalamnya?')">
            @csrf
            @method('DELETE')
            <button type="submit" class="text-[18px] hover:scale-120 duration-200 transition" style="color: {{ $deleteColor }}">
                <i class="ri-delete-bin-6-line"></i>
            </button>
        </form>
    </div>

</div>