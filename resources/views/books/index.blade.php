@extends('layouts.app')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-6">
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-3xl font-bold text-indigo-700">Libros registrados</h1>

        @if (!Auth::user()->hasRole('usuario'))
            <a href="{{ route('books.create') }}"
               class="inline-flex items-center bg-green-600 hover:bg-green-700 text-white text-sm font-medium px-4 py-2 rounded-md shadow-sm transition duration-200">
                Nuevo libro
            </a>
        @endif
    </div>

    <div class="overflow-x-auto bg-white shadow-md rounded-lg">
        <table class="min-w-full table-auto text-sm text-left">
            <thead class="bg-indigo-50 text-indigo-800 uppercase tracking-wider">
                <tr>
                    <th class="px-6 py-3 border-b">Título</th>
                    <th class="px-6 py-3 border-b">Descripción</th>
                    <th class="px-6 py-3 border-b">Autor</th>
                    @if (!Auth::user()->hasRole('usuario'))
                        <th class="px-6 py-3 border-b text-center">Acciones</th>
                    @endif
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-100">
                @forelse ($books as $book)
                    <tr class="hover:bg-gray-50">
                        <td class="px-6 py-4 font-medium text-gray-800">{{ $book->title }}</td>
                        <td class="px-6 py-4 text-gray-600">{{ $book->description }}</td>
                        <td class="px-6 py-4 text-gray-600">
                            {{ $book->author->name ?? 'Sin autor' }}
                        </td>

                        @if (!Auth::user()->hasRole('usuario'))
                            <td class="px-6 py-4 text-center space-x-2">
                                <a href="{{ route('books.edit', $book) }}"
                                   class="text-blue-600 hover:underline font-medium">Editar</a>

                                <form action="{{ route('books.destroy', $book) }}" method="POST" class="inline-block"
                                      onsubmit="return confirm('¿Estás segura de eliminar este libro?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-600 hover:underline font-medium">Eliminar</button>
                                </form>
                            </td>
                        @endif
                    </tr>
                @empty
                    <tr>
                        <td colspan="3" class="px-6 py-4 text-center text-gray-500">No hay libros registrados.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    @if ($books instanceof \Illuminate\Pagination\LengthAwarePaginator)
        <div class="mt-4">
            {{ $books->links() }}
        </div>
    @endif
</div>
@endsection
