@extends('layouts.app')

@section('content')
<div class="max-w-4xl mx-auto py-12 text-center">
    <h1 class="text-3xl font-bold text-indigo-700 mb-6">¡Bienvenido {{ Auth::user()->name }}!</h1>
    <p class="mb-4 text-gray-600">¿Qué deseas gestionar?</p>

    <div class="flex justify-center gap-6 mt-6">
        <a href="{{ route('books.index') }}"
           class="bg-indigo-600 hover:bg-indigo-700 text-white px-6 py-3 rounded-md text-lg shadow-md transition">
            📚 Libros
        </a>

        <a href="{{ route('authors.index') }}"
           class="bg-green-600 hover:bg-green-700 text-white px-6 py-3 rounded-md text-lg shadow-md transition">
            ✍️ Autores
        </a>
    </div>
</div>
@endsection
