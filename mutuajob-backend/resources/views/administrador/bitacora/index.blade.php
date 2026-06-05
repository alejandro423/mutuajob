@extends('layouts.dashboard')

@section('content')

<div class="min-h-screen bg-zinc-950 text-white p-6">

    <div class="max-w-6xl mx-auto">

        <h1 class="text-3xl font-bold mb-6">
            Bitácora
        </h1>

        <div class="bg-zinc-900 border border-zinc-800 rounded-2xl overflow-hidden">

            <table class="w-full">

                <thead class="bg-zinc-800 text-zinc-300">
                    <tr>
                        <th class="p-4 text-left">Usuario</th>
                        <th class="p-4 text-left">Acción</th>
                        <th class="p-4 text-left">Tabla</th>
                        <th class="p-4 text-left">Registro</th>
                        <th class="p-4 text-left">Fecha</th>
                    </tr>
                </thead>

                <tbody>

                    @forelse($bitacoras as $bitacora)

                        <tr class="border-t border-zinc-800">

                            <td class="p-4">
                                {{ $bitacora->user->name ?? 'Sin usuario' }}
                            </td>

                            <td class="p-4">
                                {{ $bitacora->accion }}
                            </td>

                            <td class="p-4">
                                {{ $bitacora->tabla }}
                            </td>

                            <td class="p-4">
                                {{ $bitacora->registro_id }}
                            </td>

                            <td class="p-4">
                                {{ $bitacora->created_at->format('d/m/Y H:i') }}
                            </td>

                        </tr>

                    @empty

                        <tr>
                            <td colspan="5" class="p-6 text-center text-zinc-400">
                                No hay registros en la bitácora
                            </td>
                        </tr>

                    @endforelse

                </tbody>

            </table>

        </div>

        <div class="mt-6">
            {{ $bitacoras->links() }}
        </div>

    </div>

</div>

@endsection