@extends('layouts.app')


@section('content')


{{-- Header --}}
   <div class="flex items-center gap-5 mb-8">
       <h1 class="text-3xl font-bold text-gray-800 mb-2">Recent Notes</h1>
       <div class="py-1 px-2 font-semibold border-2 border-black rounded-xl">
        <a href="{{ route('allnotes.create') }}">
           <i class="ri-add-line text-black"></i>
       </a>
       </div>
   </div>


    {{-- Content --}}
   <div class="grid grid-cols-4 gap-x-10 gap-y-10 w-fit">
       @foreach($notes as $note)
       @php
       $colors = [
           'blue' => '#4187E7',
           'green' => '#5FBB7A',
           'red' => '#EC7352',
           'yellow' => '#F5BA46',
           'purple' => '#8581E0',
       ];
       @endphp


       <div class="w-[320px] h-[380px] rounded-[24px] p-5 relative" style="background-color: {{ $colors[$note->category?->color ?? 'blue'] }}">
           <div class="flex justify-between mb-4">
               <h1 class="text-white text-[20px] font-semibold">
                   {{ $note->title }}
               </h1>


               <div class="flex gap-2">
                   <button onclick="openEditModal(
                       '{{ $note->id }}',
                       '{{ $note->title }}',
                       `{{ $note->content }}`,
                       '{{ $note->category_id }}'
                       )">
                       <i class="ri-pencil-line text-white"></i>
                   </button>
                   <button onclick="openDeleteModal('{{ $note->id }}')">
                       <i class="ri-delete-bin-line text-white"></i>
                   </button>
           </div>
       </div>


           <div class="bg-[#F4F4F4] rounded-[18px] h-[285px] px-5 py-5 relative">
               <h1 class="font-semibold">
                   {{ $note->title }}
               </h1>


           <div class="w-full h-[1px] bg-gray-300 mt-3 mb-5"></div>
               <p>{{ Str::limit($note->content, 150) }}</p>
               <span class="absolute bottom-4 right-5 text-[12px] text-gray-400">{{ $note->created_at->format('d/m/Y') }}</span>
           </div>
       </div>
       @endforeach
   </div>
</div>


   {{-- modal edit--}}
   <div id="editModal" class="fixed inset-0 z-50 hidden items-center justify-center p-4 bg-black/50 backdrop-blur-sm">
       <div class="bg-white rounded-2xl shadow-xl w-full max-w-md overflow-hidden">


           {{-- header --}}
           <div class="flex items-center justify-between px-6 py-4 bg-blue-50 border-b border-blue-100">
               <p class="text-base font-bold text-gray-900">Edit Note</p>
               <button onclick="closeModal('editModal')" class="w-8 h-8 rounded-lg flex items-center justify-center text-gray-400 hover:bg-blue-100 hover:text-gray-600 transition-all">
                   <i class="ri-close-line"></i>
               </button>
           </div>


           {{-- form --}}
           <form action="" id="editForm" method="POST" class="px-6 py-5 flex flex-col gap-4">
               @csrf
               @method('PUT')


               {{-- nama note --}}
               <div class="pb-3 pt-2">
                   <label class="block text-sm font-semibold text-gray-700 mb-1.5">Note Name</label>
                   <input name="title" id="editTitle" type="text" class="w-full px-4 py-2.5 rounded-xl border border-gray-200 bg-gray-50 text-sm text-gray-900 outline-none focus:border-yellow-400 focus:bg-white focus:ring-2 focus:ring-yellow-100 transition-all">
               </div>


               <div class="pb-3">
                   <label class="block text-sm font-semibold text-gray-700 mb-1.5">
                       Content
                   </label>


                   <textarea name="content" id="editContent" rows="5" class="w-full px-4 py-2.5 rounded-xl border border-gray-200 bg-gray-50 text-sm text-gray-900">
                   </textarea>
               </div>


               {{-- pilihan kategori --}}
               <div class="pb-4">
                   <label class="block text-sm font-semibold text-gray-700 mb-2">Choose Note Color</label>
                   <select name="category_id" id="editCategory">


                   @foreach($categories as $category)


                       <option value="{{ $category->id }}">
                           {{ $category->name }}
                       </option>
                   @endforeach
                   </select>


                   @error('color')
                       <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                   @enderror
               </div>


               {{-- action Buttons --}}
               <div class="flex gap-2 pt-1">
                   <button type="button" onclick="closeModal('editModal')"
                       class="flex-1 px-4 py-2.5 rounded-xl border border-gray-200 bg-white text-sm font-semibold text-gray-600 hover:bg-gray-50 transition-all">
                       Cancel
                   </button>
                   <button type="submit" class="flex-1 px-4 py-2.5 rounded-xl bg-[#0367F8] hover:bg-blue-600 text-white text-sm font-semibold transition-all flex items-center justify-center gap-1.5">
                       Save Changes
                   </button>
               </div>
           </form>


       </div>
   </div>


   {{-- modal hapus --}}
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
                   <button type="submit" class="w-full px-4 py-2.5 rounded-xl text-sm font-semibold text-white bg-red-500 hover:bg-red-600 transition-all flex items-center justify-center gap-1.5">
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


      function openEditModal(id, title, content, categoryId) {
           openModal('editModal');


           document.getElementById('editTitle').value = title;
           document.getElementById('editContent').value = content;
           document.getElementById('editCategory').value = categoryId;
           document.getElementById('editForm').action =`/notes/update/${id}`;
       }
       function openDeleteModal(id) {
           openModal('deleteModal');
           document.getElementById('deleteForm').action = `/notes/destroy/${id}`;
       }
     
       function closeToast() {
           const toast = document.getElementById('toast-success');
               if (toast) {
                       toast.remove();
               }
       }
   </script>
@endsection
