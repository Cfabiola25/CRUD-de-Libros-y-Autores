@extends('layouts.app')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-6">
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-3xl font-bold text-green-700">🧑‍🏫 Autores registrados</h1>
        <a href="{{ route('authors.create') }}"
            class="inline-flex items-center bg-green-600 hover:bg-green-700 text-white text-sm font-medium px-4 py-2 rounded-md shadow-sm transition duration-200">
            ➕ Nuevo autor
        </a>
    </div>

    <div class="overflow-x-auto bg-white shadow-md rounded-lg">
        <table class="min-w-full table-auto text-sm text-left">
            <thead class="bg-green-50 text-green-800 uppercase tracking-wider">
                <tr>
                    <th class="px-6 py-3 border-b">Nombre</th>
                    <th class="px-6 py-3 border-b">Biografía</th>
                    <th class="px-6 py-3 border-b text-center">Acciones</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-100">
                @forelse ($authors as $author)
                    <tr class="hover:bg-gray-50">
                        <td class="px-6 py-4">{{ $author->name }}</td>
                        <td class="px-6 py-4 text-gray-600">{{ $author->bio }}</td>
                        <td class="px-6 py-4 text-center space-x-2">
                            <a href="{{ route('authors.edit', $author) }}"
                                class="text-blue-600 hover:underline font-medium">✏️ Editar</a>
                            <form action="{{ route('authors.destroy', $author) }}" method="POST" class="inline-block"
                                  onsubmit="return confirm('¿Estás segura de eliminar este autor?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-600 hover:underline font-medium">🗑️ Eliminar</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="3" class="px-6 py-4 text-center text-gray-500">No hay autores registrados.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="mt-4">
        {{ $authors->links() }}
    </div>
</div>
@endsection
