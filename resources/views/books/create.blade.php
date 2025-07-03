@extends('layouts.app')

@section('content')
<div class="max-w-4xl mx-auto py-8">
    <h1 class="text-2xl font-bold text-indigo-700 mb-6">➕ Crear nuevo libro</h1>

    <form action="{{ route('books.store') }}" method="POST" class="space-y-6">
        @csrf
        <div>
            <label for="title" class="block text-sm font-medium text-gray-700">Título</label>
            <input type="text" name="title" id="title" required
                class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm focus:ring focus:ring-indigo-200 px-3 py-2">
        </div>

        <div>
            <label for="description" class="block text-sm font-medium text-gray-700">Descripción</label>
            <textarea name="description" id="description" rows="4"
                class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm focus:ring focus:ring-indigo-200 px-3 py-2"></textarea>
        </div>
        
        <div class="mb-4">
            <label for="author_id" class="block text-sm font-semibold text-gray-700">Autor</label>
            <select name="author_id" id="author_id" required class="mt-1 w-full border border-gray-300 rounded-md px-3 py-2">
                <option value="">-- Selecciona un autor --</option>
                @foreach($authors as $author)
                    <option value="{{ $author->id }}">{{ $author->name }}</option>
                @endforeach
            </select>
        </div>

        <div class="text-right">
            <button type="submit"
                class="bg-indigo-600 hover:bg-indigo-700 text-white px-4 py-2 rounded-md shadow-md">
                💾 Guardar libro
            </button>
        </div>
    </form>
</div>
@endsection
