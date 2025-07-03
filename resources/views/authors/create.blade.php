@extends('layouts.app')

@section('content')
<div class="max-w-2xl mx-auto py-10 px-4">
    <h1 class="text-2xl font-bold text-indigo-700 mb-6">🧑‍🏫 Nuevo Autor</h1>

    @if ($errors->any())
        <div class="bg-red-100 text-red-700 px-4 py-2 rounded mb-4">
            <ul class="list-disc pl-5">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('authors.store') }}" method="POST" class="space-y-6 bg-white p-6 rounded shadow">
        @csrf

        <div>
            <label for="name" class="block font-medium text-sm text-gray-700">Nombre del Autor</label>
            <input type="text" name="name" id="name" value="{{ old('name') }}"
                   class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500">
        </div>

        <div>
            <label for="bio" class="block font-medium text-sm text-gray-700">Biografía (opcional)</label>
            <textarea name="bio" id="bio" rows="4"
                      class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500">{{ old('bio') }}</textarea>
        </div>

        <div class="flex justify-end">
            <a href="{{ route('authors.index') }}"
               class="mr-3 inline-flex items-center text-sm text-gray-500 hover:text-gray-700">Cancelar</a>
            <button type="submit"
                    class="inline-flex items-center px-4 py-2 bg-indigo-600 text-white text-sm font-medium rounded hover:bg-indigo-700 transition">
                Guardar Autor
            </button>
        </div>
    </form>
</div>
@endsection
