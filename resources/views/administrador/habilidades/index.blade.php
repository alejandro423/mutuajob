@extends('layouts.dashboard')

@section('content')

<div class="flex items-center justify-between mb-6">

    <div>

        <h1 class="text-3xl font-bold text-white">
            Habilidades
        </h1>

        <p class="text-zinc-400 text-sm">
            Gestión de habilidades registradas
        </p>

    </div>

    <a href="{{ route('administrador.habilidades.create') }}"
       class="bg-red-600 hover:bg-red-700 text-white
              px-5 py-3 rounded-xl font-medium transition">

        Nueva habilidad

    </a>

</div>

{{-- ALERTAS --}}
@if(session('success'))

    <div class="mb-4 bg-green-600/20 border border-green-600
                text-green-400 px-4 py-3 rounded-xl">

        {{ session('success') }}

    </div>

@endif

@if(session('error'))

    <div class="mb-4 bg-red-600/20 border border-red-600
                text-red-400 px-4 py-3 rounded-xl">

        {{ session('error') }}

    </div>

@endif

{{-- TABLA --}}
<div class="bg-zinc-950 border border-zinc-800 rounded-2xl overflow-hidden">

    <table class="w-full text-left">

        <thead class="bg-zinc-900 border-b border-zinc-800">

            <tr>

                <th class="px-5 py-4 text-sm text-zinc-300">
                    Habilidad
                </th>

                <th class="px-5 py-4 text-sm text-zinc-300">
                    Fecha
                </th>

                <th class="px-5 py-4 text-sm text-zinc-300 text-center">
                    Acciones
                </th>

            </tr>

        </thead>

        <tbody>

            @forelse($habilidades as $habilidad)

                <tr class="border-b border-zinc-800 hover:bg-zinc-900/40">

                    <td class="px-5 py-4">

                        {{ $habilidad->nombre }}

                    </td>

                    <td class="px-5 py-4 text-zinc-400 text-sm">

                        {{ $habilidad->created_at?->format('d/m/Y') ?? 'Sin fecha' }}

                    </td>

                    <td class="px-5 py-4">

                        <div class="flex items-center justify-center gap-2">

                            <a href="{{ route('administrador.habilidades.edit', $habilidad->id) }}"
                               class="bg-yellow-500 hover:bg-yellow-600
                                      px-3 py-2 rounded-lg text-sm
                                      text-black font-medium transition">

                                Editar

                            </a>

                            <form action="{{ route('administrador.habilidades.destroy', $habilidad->id) }}"
                                  method="POST"
                                  class="form-eliminar">

                                @csrf
                                @method('DELETE')

                                <button type="submit"
                                        class="bg-red-600 hover:bg-red-700
                                               px-3 py-2 rounded-lg
                                               text-sm transition">

                                    Eliminar

                                </button>

                            </form>

                        </div>

                    </td>

                </tr>

            @empty

                <tr>

                    <td colspan="3"
                        class="px-5 py-6 text-center text-zinc-500">

                        No hay habilidades registradas.

                    </td>

                </tr>

            @endforelse

        </tbody>

    </table>

</div>

{{-- PAGINACION --}}
<div class="mt-4">

    {{ $habilidades->links() }}

</div>

{{-- SWEET ALERT --}}
<script>

    document.querySelectorAll('.form-eliminar').forEach(form => {

        form.addEventListener('submit', function(e) {

            e.preventDefault();

            Swal.fire({

                title: '¿Eliminar habilidad?',
                text: 'Esta acción no se puede deshacer.',
                icon: 'warning',
                background: '#18181b',
                color: '#fff',
                showCancelButton: true,
                confirmButtonColor: '#dc2626',
                cancelButtonColor: '#3f3f46',
                confirmButtonText: 'Sí, eliminar',
                cancelButtonText: 'Cancelar'

            }).then((result) => {

                if (result.isConfirmed) {

                    form.submit();

                }

            });

        });

    });

</script>

@endsection