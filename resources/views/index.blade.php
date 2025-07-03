@extends('layouts.app')

@section('content')
<div class="max-w-6xl mx-auto py-12 px-4 sm:px-6 lg:px-8">
    <div class="text-center mb-12">
        <h1 class="text-4xl font-extrabold text-indigo-700">📚 Sistema de Gestión de Libros y Autores</h1>
        <p class="mt-3 text-lg text-gray-500">Administra de forma eficiente tus recursos</p>
    </div>

    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-8">
        <!-- Libros -->
        <a href="{{ route('books.index') }}"
           class="transform transition-all duration-200 hover:scale-105 bg-white border border-indigo-200 hover:border-indigo-400 shadow-md hover:shadow-xl rounded-2xl p-6 text-center">
            <div class="text-3xl">📘</div>
            <h2 class="text-xl font-bold text-indigo-600 mt-2">Libros</h2>
            <p class="text-gray-500 mt-1">Crear, ver y editar libros</p>
        </a>

        <!-- Autores -->
        <a href="{{ route('authors.index') }}"
           class="transform transition-all duration-200 hover:scale-105 bg-white border border-green-200 hover:border-green-400 shadow-md hover:shadow-xl rounded-2xl p-6 text-center">
            <div class="text-3xl">🧑‍🏫</div>
            <h2 class="text-xl font-bold text-green-600 mt-2">Autores</h2>
            <p class="text-gray-500 mt-1">Gestión completa de autores</p>
        </a>

        <!-- Auditorías (solo si es admin o superadmin) -->
        @if(auth()->user()?->role === 'admin' || auth()->user()?->role === 'superadmin')
            <a href="{{ route('audits.index') }}"
               class="transform transition-all duration-200 hover:scale-105 bg-white border border-red-200 hover:border-red-400 shadow-md hover:shadow-xl rounded-2xl p-6 text-center">
                <div class="text-3xl">🕵️‍♀️</div>
                <h2 class="text-xl font-bold text-red-600 mt-2">Auditorías</h2>
                <p class="text-gray-500 mt-1">Monitorea cambios y acciones</p>
            </a>
        @endif
    </div>
</div>
@endsection
