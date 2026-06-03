@extends('layouts.app')

@section('content')
    {{-- Content --}}
    <div class="max-w-3xl mx-auto">

        <div class="flex items-center justify-between mb-10">
            <h1 class="text-4xl font-bold">Make A New Note</h1>
            <a href="{{ route('allnotes.index') }}" class="px-5 py-2 bg-gray-100 rounded-xl">Back</a>
        </div>

        <form action="{{ route('allnotes.store') }}" method="POST" class="bg-white rounded-3xl p-8 shadow">
            @csrf
            <div class="mb-6">
                <label class="font-semibold block mb-2">Note Title</label>
                <input type="text" name="title" class="w-full border rounded-xl p-3" placeholder="Enter note title">
            </div>

            <div class="mb-6">
                <label class="font-semibold block mb-2">Note Content</label>
                <textarea name="content" rows="10" class="w-full border rounded-xl p-3" placeholder="Write your note..."></textarea>
            </div>

            <div class="mb-8">
                <label class="font-semibold block mb-3">
                    Note Category
                </label>

                @php
                    $colors = [
                        'blue' => '#4187E7',
                        'green' => '#5FBB7A',
                        'red' => '#EC7352',
                        'yellow' => '#F5BA46',
                        'purple' => '#8581E0',
                    ];
                @endphp

                @foreach ($categories as $category)
                    <label class="flex items-center gap-2 mb-2">
                        <input type="radio" name="category_id" value="{{ $category->id }}" required>
                        <span class="w-4 h-4 rounded-full" style="background-color: {{ $colors[$category->color] }}"></span>
                        {{ $category->name }}
                    </label>
                @endforeach

            </div>


            <button type="submit" class="px-6 py-3 bg-[#0367F8] text-white rounded-xl">Save Note</button>

        </form>
    </div>
@endsection
