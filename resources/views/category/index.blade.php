@extends('layouts.app')

@section('content')
    {{-- Header --}}
    <div class="flex items-center gap-5 mb-8">
        <h1 class="text-3xl font-bold text-gray-800 mb-2">Category</h1>
        <div class="py-1 px-2 font-bold border-2 border-black rounded-xl">
            <button onclick="openAddModal()">
                <i class="ri-add-line text-black"></i>
            </button>
        </div>
    </div>

    {{-- Alert Message --}}
    @if (session('success'))
        <div id="toast-success"
            class="fixed top-6 right-6 z-50 flex items-center gap-3 px-4 py-3 rounded-2xl bg-white border border-gray-100 shadow-xl min-w-[320px] animate-slide-in">

            {{-- Icon --}}
            <div class="w-10 h-10 rounded-xl bg-emerald-100 flex items-center justify-center shrink-0">
                <i class="ri-check-line text-green-800 text-lg"></i>
            </div>

            {{-- Text --}}
            <div class="flex-1">
                <p class="text-sm font-semibold text-gray-800">
                    Success
                </p>

                <p class="text-xs text-gray-500 mt-0.5">
                    {{ session('success') }}
                </p>
            </div>

            {{-- Close --}}
            <button onclick="closeToast()" class="text-gray-300 hover:text-gray-500 transition-all">
                <i class="ri-close-line text-lg"></i>
            </button>
        </div>
    @endif

    {{-- Content --}}
    <div class="grid grid-cols-4 gap-x-10 gap-y-10 w-fit h-full overflow-y-auto">

        @foreach ($categories as $category)
            @php
                // mapping warna dari database ke class tailwind
                $bgBack =
                    [
                        'blue' => 'bg-[#8EBEFF]',
                        'green' => 'bg-[#95D9A9]',
                        'red' => 'bg-[#FFA891]',
                        'yellow' => 'bg-[#FFD480]',
                        'purple' => 'bg-[#C7C5FF]',
                    ][$category->color] ?? 'bg-[#D1D1D1]';

                $bgFront =
                    [
                        'blue' => 'bg-[#4187E7] before:bg-[#4187E7]',
                        'green' => 'bg-[#5FBB7A] before:bg-[#5FBB7A]',
                        'red' => 'bg-[#EC7352] before:bg-[#EC7352]',
                        'yellow' => 'bg-[#F5BA46] before:bg-[#F5BA46]',
                        'purple' => 'bg-[#8581E0] before:bg-[#8581E0]',
                    ][$category->color] ?? 'bg-[#A0A0A0] before:bg-[#A0A0A0]';

                // [ warna text ]
                $textColor = in_array($category->color, ['yellow', 'blue', 'green', 'red', 'purple'])
                    ? 'text-white'
                    : 'text-white/80';

                $subColor = in_array($category->color, ['yellow', 'blue', 'green', 'red', 'purple'])
                    ? 'text-white'
                    : 'text-white/80';
            @endphp

            {{-- Folder --}}
            <div class="relative aspect-[1.15/1] flex flex-col w-64 mb-2">
                {{-- Back Folder) --}}
                <div class="absolute inset-0 {{ $bgBack }} rounded-[24px] z-10"></div>

                <div
                    class="absolute top-[16px] left-[24px] right-[24px] h-[35%] bg-white/70 rounded-t-[16px] z-15 transform rotate-[-1deg]">
                </div>

                <div
                    class="absolute top-[20px] left-[16px] right-[16px] h-[45%] bg-white z-20 shadow-[0_4px_12px_rgba(0,0,0,0.15)] rounded-[4px]">
                    <div class="absolute top-0 left-[60px] w-[20px] h-[20px] rounded-[12px]"></div>
                </div>

                {{-- Front Folder --}}
                <div
                    class="absolute bottom-0 left-0 w-full h-[78%] {{ $bgFront }} rounded-br-[24px] rounded-bl-[24px] rounded-tr-[24px] z-30 p-5 flex flex-col justify-center before:content-[''] before:absolute before:-top-[16px] before:left-0 before:w-[60%] before:h-[16px] before:rounded-t-[16px]">

                    <div class="absolute bottom-3 right-3 flex items-center gap-2 z-40">

                        {{-- Edit Button --}}
                        <button
                            onclick="openEditModal({{ $category->id }}, '{{ $category->name }}', '{{ $category->color }}')"
                            type="button"
                            class="p-1.5 bg-white/60 hover:bg-white rounded-full text-[#555555] transition-colors shadow-sm"
                            title="Edit Folder">
                            <i class="ri-pencil-line text-base px-1"></i>
                        </button>

                        {{-- Delete Button --}}
                        <button
                            onclick="openDeleteModal({{ $category->id }}, '{{ $category->name }}', '{{ $category->color }}')"
                            type="button"
                            class="p-1.5 bg-white/60 hover:bg-red-50 hover:text-red-600 rounded-full text-[#555555] transition-colors shadow-sm"
                            title="Hapus Folder">
                            <i class="ri-delete-bin-line text-base px-1"></i>
                        </button>
                    </div>

                    {{-- Text --}}
                    <h3 class="text-[24px] font-bold {{ $textColor }} mb-1 pr-14 tracking-wide truncate">
                        {{ $category->name }}</h3>
                    <p class="text-[14px] font-medium {{ $subColor }}">{{ $category->notes_count }}5 Notes</p>
                    <div class="mt-auto">
                        <p
                            class="w-fit bg-white/80 text-left text-[10px] font-semibold tracking-wide uppercase text-gray-700 px-2 py-1 rounded-md">
                            {{ $category->slug }}
                        </p>
                    </div>
                </div>
            </div>
        @endforeach

    </div>

    {{-- MODAL TAMBAH --}}
    <div id="addModal" class="fixed inset-0 z-50 hidden items-center justify-center p-4 bg-black/50 backdrop-blur-sm">
        <div class="bg-white rounded-2xl shadow-xl w-full max-w-md overflow-hidden">

            {{-- Header --}}
            <div class="flex items-center justify-between px-6 py-4 bg-blue-50 border-b border-blue-100">
                <h3 class="text-base font-bold text-gray-900">Add Category</h3>
                <button onclick="closeModal('addModal')"
                    class="w-8 h-8 rounded-lg flex items-center justify-center text-gray-400 hover:bg-blue-100 hover:text-gray-600 transition-all">
                    <i class="ri-close-line"></i>
                </button>
            </div>

            {{-- Form --}}
            <form action="{{ route('category.store') }}" method="POST" class="px-6 py-5 flex flex-col gap-4">
                @csrf

                {{-- Nama Kategori --}}
                <div class="pb-3 pt-2">
                    <label class="block text-sm font-semibold text-gray-700 mb-1.5">Category Name</label>
                    <input name="name" type="text" placeholder="Example: Goals"
                        class="w-full px-4 py-2.5 rounded-xl border border-gray-200 bg-gray-50 text-sm text-gray-900 placeholder-gray-400 outline-none focus:border-blue-400 focus:bg-white focus:ring-2 focus:ring-blue-100 transition-all">
                    @error('name')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Pilihan Warna --}}
                <div class="pb-4">
                    <label class="block text-sm font-semibold text-gray-700 mb-2">Choose Category Color</label>
                    <div class="flex items-center gap-3">

                        {{-- Biru --}}
                        <label class="relative flex items-center justify-center cursor-pointer">
                            <input type="radio" name="color" value="blue" class="sr-only peer"
                                {{ old('color', $category->color ?? 'blue') == 'blue' ? 'checked' : '' }}>
                            <span
                                class="w-8 h-8 rounded-full bg-[#4187E7] border-2 border-transparent peer-checked:border-gray-900 peer-checked:scale-110 transition-all"></span>
                        </label>

                        {{-- Hijau --}}
                        <label class="relative flex items-center justify-center cursor-pointer">
                            <input type="radio" name="color" value="green" class="sr-only peer"
                                {{ old('color', $category->color ?? '') == 'green' ? 'checked' : '' }}>
                            <span
                                class="w-8 h-8 rounded-full bg-[#5FBB7A] border-2 border-transparent peer-checked:border-gray-900 peer-checked:scale-110 transition-all"></span>
                        </label>

                        {{-- Merah --}}
                        <label class="relative flex items-center justify-center cursor-pointer">
                            <input type="radio" name="color" value="red" class="sr-only peer"
                                {{ old('color', $category->color ?? '') == 'red' ? 'checked' : '' }}>
                            <span
                                class="w-8 h-8 rounded-full bg-[#EC7352] border-2 border-transparent peer-checked:border-gray-900 peer-checked:scale-110 transition-all"></span>
                        </label>

                        {{-- Kuning --}}
                        <label class="relative flex items-center justify-center cursor-pointer">
                            <input type="radio" name="color" value="yellow" class="sr-only peer"
                                {{ old('color', $category->color ?? '') == 'yellow' ? 'checked' : '' }}>
                            <span
                                class="w-8 h-8 rounded-full bg-[#F5BA46] border-2 border-transparent peer-checked:border-gray-900 peer-checked:scale-110 transition-all"></span>
                        </label>

                        {{-- Ungu --}}
                        <label class="relative flex items-center justify-center cursor-pointer">
                            <input type="radio" name="color" value="purple" class="sr-only peer"
                                {{ old('color', $category->color ?? '') == 'purple' ? 'checked' : '' }}>
                            <span
                                class="w-8 h-8 rounded-full bg-[#8581E0] border-2 border-transparent peer-checked:border-gray-900 peer-checked:scale-110 transition-all"></span>
                        </label>

                    </div>
                    @error('color')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Action buttons --}}
                <div class="flex gap-2 pt-1">
                    <button type="button" onclick="closeModal('addModal')"
                        class="flex-1 px-4 py-2.5 rounded-xl border border-gray-200 bg-white text-sm font-semibold text-gray-600 hover:bg-gray-50 transition-all">Cancel</button>
                    <button type="submit"
                        class="flex-1 px-4 py-2.5 rounded-xl bg-[#0367F8] hover:bg-blue-600 text-white text-sm font-semibold transition-all flex items-center justify-center gap-1.5">Save</button>

                    @if ($errors->any())
                        <script>
                            document.addEventListener('DOMContentLoaded', function() {
                                openModal('addModal');
                            });
                        </script>
                    @endif
                </div>
            </form>

        </div>
    </div>

    {{-- MODAL EDIT --}}
    <div id="editModal" class="fixed inset-0 z-50 hidden items-center justify-center p-4 bg-black/50 backdrop-blur-sm">
        <div class="bg-white rounded-2xl shadow-xl w-full max-w-md overflow-hidden">

            {{-- Header --}}
            <div class="flex items-center justify-between px-6 py-4 bg-blue-50 border-b border-blue-100">
                <p class="text-base font-bold text-gray-900">Edit Category</p>
                <button onclick="closeModal('editModal')"
                    class="w-8 h-8 rounded-lg flex items-center justify-center text-gray-400 hover:bg-blue-100 hover:text-gray-600 transition-all">
                    <i class="ri-close-line"></i>
                </button>
            </div>

            {{-- Form --}}
            <form action="{{ route('category.update', $category->id) }}" id="editForm" method="POST"
                class="px-6 py-5 flex flex-col gap-4">
                @csrf
                @method('PUT')

                {{-- Nama Kategori --}}
                <div class="pb-3 pt-2">
                    <label class="block text-sm font-semibold text-gray-700 mb-1.5">Category Name</label>
                    <input name="name" id="editName" type="text"
                        class="w-full px-4 py-2.5 rounded-xl border border-gray-200 bg-gray-50 text-sm text-gray-900 outline-none focus:border-yellow-400 focus:bg-white focus:ring-2 focus:ring-yellow-100 transition-all">
                </div>

                {{-- Pilihan Warna --}}
                <div class="pb-4">
                    <label class="block text-sm font-semibold text-gray-700 mb-2">Choose Category Color</label>
                    <div class="flex items-center gap-3">

                        {{-- Biru --}}
                        <label class="relative flex items-center justify-center cursor-pointer">
                            <input type="radio" name="color" value="blue" class="sr-only peer"
                                {{ old('color', $category->color ?? 'blue') == 'blue' ? 'checked' : '' }}>
                            <span
                                class="w-8 h-8 rounded-full bg-[#4187E7] border-2 border-transparent peer-checked:border-gray-900 peer-checked:scale-110 transition-all"></span>
                        </label>

                        {{-- Hijau --}}
                        <label class="relative flex items-center justify-center cursor-pointer">
                            <input type="radio" name="color" value="green" class="sr-only peer"
                                {{ old('color', $category->color ?? '') == 'green' ? 'checked' : '' }}>
                            <span
                                class="w-8 h-8 rounded-full bg-[#5FBB7A] border-2 border-transparent peer-checked:border-gray-900 peer-checked:scale-110 transition-all"></span>
                        </label>

                        {{-- Merah --}}
                        <label class="relative flex items-center justify-center cursor-pointer">
                            <input type="radio" name="color" value="red" class="sr-only peer"
                                {{ old('color', $category->color ?? '') == 'red' ? 'checked' : '' }}>
                            <span
                                class="w-8 h-8 rounded-full bg-[#EC7352] border-2 border-transparent peer-checked:border-gray-900 peer-checked:scale-110 transition-all"></span>
                        </label>

                        {{-- Kuning --}}
                        <label class="relative flex items-center justify-center cursor-pointer">
                            <input type="radio" name="color" value="yellow" class="sr-only peer"
                                {{ old('color', $category->color ?? '') == 'yellow' ? 'checked' : '' }}>
                            <span
                                class="w-8 h-8 rounded-full bg-[#F5BA46] border-2 border-transparent peer-checked:border-gray-900 peer-checked:scale-110 transition-all"></span>
                        </label>

                        {{-- Ungu --}}
                        <label class="relative flex items-center justify-center cursor-pointer">
                            <input type="radio" name="color" value="purple" class="sr-only peer"
                                {{ old('color', $category->color ?? '') == 'purple' ? 'checked' : '' }}>
                            <span
                                class="w-8 h-8 rounded-full bg-[#8581E0] border-2 border-transparent peer-checked:border-gray-900 peer-checked:scale-110 transition-all"></span>
                        </label>

                    </div>
                    @error('color')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Action Buttons --}}
                <div class="flex gap-2 pt-1">
                    <button type="button" onclick="closeModal('editModal')"
                        class="flex-1 px-4 py-2.5 rounded-xl border border-gray-200 bg-white text-sm font-semibold text-gray-600 hover:bg-gray-50 transition-all">
                        Cancel
                    </button>
                    <button type="submit"
                        class="flex-1 px-4 py-2.5 rounded-xl bg-[#0367F8] hover:bg-blue-600 text-white text-sm font-semibold transition-all flex items-center justify-center gap-1.5">
                        Save Changes
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

    {{-- JS --}}
    <script>
        function openModal(id) {
            const m = document.getElementById(id);
            m.classList.remove('hidden');
            m.classList.add('flex');
        }

        function closeModal(id) {
            const m = document.getElementById(id);
            m.classList.add('hidden');
            m.classList.remove('flex');
        }

        function openAddModal() {
            openModal('addModal');
            setTimeout(() => document.getElementById('addName').focus(), 100);
        }

        function openEditModal(id, name) {
            openModal('editModal');
            document.getElementById('editName').value = name
            document.getElementById('editForm').action = `/category/update/${id}`
        }

        function openDeleteModal(id) {
            openModal('deleteModal');
            document.getElementById('deleteForm').action = `/category/destroy/${id}`;
        }
       
        function closeToast() {
            const toast = document.getElementById('toast-success');
                if (toast) {
                        toast.remove();
                }
        }
    </script>
@endsection
