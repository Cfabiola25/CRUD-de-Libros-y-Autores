@extends('layouts.app') {{-- Usa la plantilla general de tu app --}}

@section('content')
<div class="container">
    <h2 class="text-2xl font-bold mb-4">Registros de Auditoría</h2>

    {{-- Formulario para filtrar por usuario y tipo de evento --}}
    <form method="GET" class="mb-4 flex gap-2">
        <input type="text" name="user" placeholder="Filtrar por ID de usuario" class="border p-1 rounded">
        <input type="text" name="event" placeholder="Filtrar por acción (created, updated, deleted)" class="border p-1 rounded">
        <button class="bg-blue-500 text-white px-3 py-1 rounded">Filtrar</button>
    </form>

    {{-- Tabla con los datos de auditoría --}}
    <table class="table-auto w-full border-collapse border border-gray-300">
        <thead class="bg-gray-100">
            <tr>
                <th class="border p-2">Modelo</th>
                <th class="border p-2">Acción</th>
                <th class="border p-2">Usuario</th>
                <th class="border p-2">Fecha</th>
                <th class="border p-2">Detalles</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($audits as $audit)
                <tr>
                    <td class="border p-2">{{ $audit->auditable_type }}</td>
                    <td class="border p-2">{{ $audit->event }}</td>
                    <td class="border p-2">{{ $audit->user->name ?? 'Sistema' }}</td>
                    <td class="border p-2">{{ $audit->created_at->format('d/m/Y H:i') }}</td>
                    <td class="border p-2 text-xs">
                        <pre>{{ json_encode($audit->new_values, JSON_PRETTY_PRINT) }}</pre>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    {{-- Paginación --}}
    <div class="mt-4">
        {{ $audits->links() }}
    </div>
</div>
@endsection
