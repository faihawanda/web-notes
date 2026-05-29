@extends('layouts.app')

@section('content')
    {{-- Header --}}
    <div class="flex items-center gap-5 mb-8">
        <h1 class="text-3xl font-bold text-gray-800 mb-2">Category</h1>
        <div class="py-1 px-2 font-bold border border-2 border-black rounded-xl">
            <button onclick="openAddModal()">
                <i class="ri-add-line text-black"></i>
            </button>
        </div>
    </div>

    {{-- Content --}}
    <div class="grid grid-cols-4 gap-x-10 gap-y-10 w-fit">

        @foreach ($categories as $category)
    @php
        // Mapping warna dari database ke class Tailwind (Background Utama & Background Tab/Depan)
        $bgBack = [
            'blue'   => 'bg-blue-400',
            'green'  => 'bg-emerald-400',
            'red'    => 'bg-rose-400',
            'yellow' => 'bg-amber-400',
            'purple' => 'bg-purple-400',
        ][$category->color] ?? 'bg-[#b3b3b3]'; // fallback abu-abu jika tidak cocok

        $bgFront = [
            'blue'   => 'bg-blue-500 before:bg-blue-500',
            'green'  => 'bg-emerald-500 before:bg-emerald-500',
            'red'    => 'bg-rose-500 before:bg-rose-500',
            'yellow' => 'bg-amber-500 before:bg-amber-500',
            'purple' => 'bg-purple-500 before:bg-purple-500',
        ][$category->color] ?? 'bg-[#d9d9d9] before:bg-[#d9d9d9]';
        
        // Warna teks agar kontras dengan warna folder baru
        $textColor = in_array($category->color, ['blue', 'green', 'red', 'purple']) ? 'text-white' : 'text-gray-800';
        $subColor = in_array($category->color, ['blue', 'green', 'red', 'purple']) ? 'text-white/80' : 'text-gray-600';
    @endphp

    {{-- Folder --}}
    <div class="relative aspect-[1.15/1] flex flex-col w-64 mb-6">
        {{-- Bagian Belakang Folder (Ubah ke dinamis) --}}
        <div class="absolute inset-0 {{ $bgBack }} rounded-[24px] z-10"></div>

        <div class="absolute top-[16px] left-[24px] right-[24px] h-[35%] bg-white/70 rounded-t-[16px] z-15 transform rotate-[-1deg]"></div>

        <div class="absolute top-[20px] left-[16px] right-[16px] h-[45%] bg-white z-20 shadow-[0_4px_12px_rgba(0,0,0,0.15)] rounded-[4px]">
            <div class="absolute top-0 left-[60px] w-[20px] h-[20px] rounded-[12px]"></div>
        </div>

        {{-- Bagian Depan Folder & Tab Sebelum (Ubah ke dinamis) --}}
        <div class="absolute bottom-0 left-0 w-full h-[78%] {{ $bgFront }} rounded-br-[24px] rounded-bl-[24px] rounded-tr-[24px] z-30 p-5 flex flex-col justify-center before:content-[''] before:absolute before:-top-[16px] before:left-0 before:w-[60%] before:h-[16px] before:rounded-t-[16px]">

            <div class="absolute bottom-3 right-3 flex items-center gap-2 z-40">
                <button type="button"
                    class="p-1.5 bg-white/60 hover:bg-white rounded-full text-[#555555] transition-colors shadow-sm"
                    title="Edit Folder">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z" />
                    </svg>
                </button>
                <button type="button"
                    class="p-1.5 bg-white/60 hover:bg-red-50 hover:text-red-600 rounded-full text-[#555555] transition-colors shadow-sm"
                    title="Hapus Folder">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                    </svg>
                </button>
            </div>

            {{-- Teks judul dan deskripsi disesuaikan warnanya agar kontras --}}
            <h3 class="text-[24px] font-bold {{ $textColor }} mb-1 pr-14 tracking-wide truncate">{{ $category->name }}</h3>
            <p class="text-[14px] font-medium {{ $subColor }}"> notes</p>
        </div>
    </div>
@endforeach

    </div>

    {{-- ════ MODAL TAMBAH ════ --}}
    <div id="addModal" class="fixed inset-0 z-50 hidden items-center justify-center p-4 bg-black/50 backdrop-blur-sm">
        <div class="bg-white rounded-2xl shadow-xl w-full max-w-md overflow-hidden">

            {{-- Header --}}
            <div class="flex items-center justify-between px-6 py-4 bg-blue-50 border-b border-blue-100">
                <h3 class="text-sm font-bold text-gray-900">Tambah Kategori</h3>
                <button onclick="closeModal('addModal')"
                    class="w-8 h-8 rounded-lg flex items-center justify-center text-gray-400 hover:bg-blue-100 hover:text-gray-600 transition-all">
                    <i class="ri-close-line"></i>
                </button>
            </div>

            {{-- Form --}}
            <form action="{{ route('category.store') }}" method="POST" class="px-6 py-5 flex flex-col gap-4">
                @csrf

                {{-- Nama Kategori --}}
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-1.5">Nama Kategori</label>
                    <input name="name" type="text" placeholder="Contoh: Pemrograman"
                        class="w-full px-4 py-2.5 rounded-xl border border-gray-200 bg-gray-50 text-sm text-gray-900 placeholder-gray-400 outline-none focus:border-blue-400 focus:bg-white focus:ring-2 focus:ring-blue-100 transition-all">
                    @error('name')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Pilihan Warna --}}
<div>
    <label class="block text-sm font-semibold text-gray-700 mb-2">Pilih Warna Kategori</label>
    <div class="flex items-center gap-3">
        
        {{-- Warna 1: Biru (Default Checked jika tidak ada data) --}}
        <label class="relative flex items-center justify-center cursor-pointer">
            <input type="radio" name="color" value="blue" class="sr-only peer" 
                {{ (old('color', $category->color ?? 'blue') == 'blue') ? 'checked' : '' }}>
            <span class="w-8 h-8 rounded-full bg-blue-500 border-2 border-transparent peer-checked:border-gray-900 peer-checked:scale-110 transition-all"></span>
        </label>

        {{-- Warna 2: Hijau --}}
        <label class="relative flex items-center justify-center cursor-pointer">
            <input type="radio" name="color" value="green" class="sr-only peer"
                {{ (old('color', $category->color ?? '') == 'green') ? 'checked' : '' }}>
            <span class="w-8 h-8 rounded-full bg-emerald-500 border-2 border-transparent peer-checked:border-gray-900 peer-checked:scale-110 transition-all"></span>
        </label>

        {{-- Warna 3: Merah --}}
        <label class="relative flex items-center justify-center cursor-pointer">
            <input type="radio" name="color" value="red" class="sr-only peer"
                {{ (old('color', $category->color ?? '') == 'red') ? 'checked' : '' }}>
            <span class="w-8 h-8 rounded-full bg-rose-500 border-2 border-transparent peer-checked:border-gray-900 peer-checked:scale-110 transition-all"></span>
        </label>

        {{-- Warna 4: Kuning --}}
        <label class="relative flex items-center justify-center cursor-pointer">
            <input type="radio" name="color" value="yellow" class="sr-only peer"
                {{ (old('color', $category->color ?? '') == 'yellow') ? 'checked' : '' }}>
            <span class="w-8 h-8 rounded-full bg-amber-500 border-2 border-transparent peer-checked:border-gray-900 peer-checked:scale-110 transition-all"></span>
        </label>

        {{-- Warna 5: Ungu --}}
        <label class="relative flex items-center justify-center cursor-pointer">
            <input type="radio" name="color" value="purple" class="sr-only peer"
                {{ (old('color', $category->color ?? '') == 'purple') ? 'checked' : '' }}>
            <span class="w-8 h-8 rounded-full bg-purple-500 border-2 border-transparent peer-checked:border-gray-900 peer-checked:scale-110 transition-all"></span>
        </label>

    </div>
    @error('color')
        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
    @enderror
</div>

                {{-- Action buttons --}}
                <div class="flex gap-2 pt-1">
                    <button type="button" onclick="closeModal('addModal')"
                        class="flex-1 px-4 py-2.5 rounded-xl border border-gray-200 bg-white text-sm font-semibold text-gray-600 hover:bg-gray-50 transition-all">Batal</button>
                    <button type="submit"
                        class="flex-1 px-4 py-2.5 rounded-xl bg-blue-500 hover:bg-blue-600 text-white text-sm font-semibold transition-all flex items-center justify-center gap-1.5">Simpan</button>
                </div>
            </form>

        </div>
    </div>

    {{-- ════ MODAL EDIT ════ --}}
    <div id="editModal" class="fixed inset-0 z-50 hidden items-center justify-center p-4 bg-black/50 backdrop-blur-sm">
        <div class="bg-white rounded-2xl shadow-xl w-full max-w-md overflow-hidden">


            {{-- Header --}}
            <div class="flex items-center justify-between px-6 py-4 bg-yellow-50 border-b border-yellow-100">
                <p class="text-xs text-gray-500">Ubah nama Kategori</p>
                <button onclick="closeModal('editModal')"
                    class="w-8 h-8 rounded-lg flex items-center justify-center text-gray-400 hover:bg-yellow-100 hover:text-gray-600 transition-all">
                    <i class="ri-close-line"></i>
                </button>
            </div>


            {{-- Form --}}
            <form id="editForm" method="POST" class="px-6 py-5 flex flex-col gap-4">
                @csrf
                @method('PUT')
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-1.5">Nama Kategori</label>
                    <input name="name" id="editName" type="text"
                        class="w-full px-4 py-2.5 rounded-xl border border-gray-200 bg-gray-50 text-sm text-gray-900 outline-none focus:border-yellow-400 focus:bg-white focus:ring-2 focus:ring-yellow-100 transition-all">
                </div>
                <div class="flex gap-2 pt-1">
                    <button type="button" onclick="closeModal('editModal')"
                        class="flex-1 px-4 py-2.5 rounded-xl border border-gray-200 bg-white text-sm font-semibold text-gray-600 hover:bg-gray-50 transition-all">
                        Batal
                    </button>
                    <button type="submit"
                        class="flex-1 px-4 py-2.5 rounded-xl bg-yellow-400 hover:bg-yellow-500 text-white text-sm font-semibold transition-all flex items-center justify-center gap-1.5">
                        Simpan Perubahan
                    </button>
                </div>
            </form>


        </div>
    </div>

    {{-- ════ MODAL HAPUS ════ --}}
    <div id="deleteModal" class="fixed inset-0 z-50 hidden items-center justify-center p-4 bg-black/50 backdrop-blur-sm">
        <div class="bg-white rounded-2xl shadow-xl w-full max-w-sm overflow-hidden">
            <div class="px-6 pt-6 pb-5">
                <h3 class="text-base font-bold text-gray-900 text-center mb-1">Hapus Kategori?</h3>
            </div>
            <div class="px-6 pb-6 flex gap-2">
                <button onclick="closeModal('deleteModal')"
                    class="flex-1 px-4 py-2.5 rounded-xl border border-gray-200 bg-white text-sm font-semibold text-gray-600 hover:bg-gray-50 transition-all">
                    Batal
                </button>
                <form id="deleteForm" method="POST" class="flex-1">
                    @csrf
                    @method('DELETE')
                    <button type="submit"
                        class="w-full px-4 py-2.5 rounded-xl text-sm font-semibold text-white bg-red-500 hover:bg-red-600 transition-all flex items-center justify-center gap-1.5">
                        Ya, Hapus
                    </button>
                </form>
            </div>


        </div>
    </div>

    {{-- JS --}}
    <script>
        /* ─── Modal helpers ─── */
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

        /* ─── Add modal ─── */
        function openAddModal() {
            openModal('addModal');
            setTimeout(() => document.getElementById('addName').focus(), 100);
        }

        /* ─── Edit modal ─── */
        function openEditModal(id, name) {
            openModal('editModal');
            document.getElementById('editName').value = name
            document.getElementById('editForm').action = `/categories/update/${id}`
        }

        /* ─── Delete modal ─── */
        function openDeleteModal(id) {
            openModal('deleteModal');
            document.getElementById('deleteForm').action = `/categories/destroy/${id}`;
        }
    </script>
@endsection
