@extends('layout.layout')

@section('styles')
<style>
    @font-face {
        font-family: 'Cinzel';
        src: url({{ storage_path('fonts/Cinzel.ttf') }});
    }
    .fecha {
        /* margin-top: 5px; */
    }

    .nombre-semana {
        font-size: 25px;
    }

    /* .dia {
        font-size: 80px;
        padding-left: 10px;
        padding-right: 10px;
    } */

    /* .mes, .anio {
        padding-left: 10px;
        padding-right: 10px;
    } */

    /* .mes {
        border-right: 2px solid #6D6E60;
    }

    .anio {
        border-left: 2px solid #6D6E60;
    } */
    .lugar {
        /* line-height: 0.9; */
    }
    .text-leyenda {
        font-size: 15px;
        line-height: 0.5;
        /* padding-top: 8px; */
    }
</style>
@endsection

@section('content')
<main class="p-6 sm:p-10 space-y-6">
    <div class="flex flex-col space-y-6 md:space-y-0 md:flex-row justify-between">
        <div class="mr-6">
            <h1 class="text-4xl font-semibold mb-2">Dashboard</h1>
            <h2 class="text-gray-600 ml-0.5">Nuestra Boda</h2>
        </div>
        <div class="flex flex-wrap items-start justify-end -mb-3">
            <button class="inline-flex px-5 py-3 text-white bg-blue-600 hover:bg-purple-700 focus:bg-blue-700 rounded-md ml-6 mb-3" data-modal-target="default-modal" data-modal-toggle="default-modal">
                <svg aria-hidden="true" fill="none" viewBox="0 0 24 24" stroke="currentColor" class="flex-shrink-0 h-6 w-6 text-white -ml-1 mr-2">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                </svg>
                Registrar Invitado
            </button>
        </div>
    </div>
    <section class="grid md:grid-cols-2 xl:grid-cols-4 gap-6">
        <div class="flex items-center p-8 bg-white shadow rounded-lg">
            <div class="inline-flex flex-shrink-0 items-center justify-center h-16 w-16 text-blue-600 bg-blue-100 rounded-full mr-6">
                <svg aria-hidden="true" fill="none" viewBox="0 0 24 24" stroke="currentColor" class="h-6 w-6">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
                </svg>
            </div>
            <div>
                <span class="block text-2xl font-bold">{{ $invitados->count() }}</span>
                <span class="block text-gray-500">Invitados</span>
            </div>
        </div>
    </section>
    <section class="grid md:grid-cols-1 xl:grid-cols-1 xl:grid-rows-3 xl:grid-flow-col gap-6">
        <div class="flex flex-col md:col-span-2 md:row-span-2 bg-white shadow rounded-lg">
            <div class="px-6 py-5 font-semibold border-b border-gray-100">Listado de Invitados</div>
            <div class="p-4 flex-grow">
            <table id="invitados">
                <thead>
                    <tr>
                    <th>Invitado</th>
                    <th>Cantidad Invitados Pase</th>
                    <th>Opciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($invitados as $invitado)
                        <tr>
                            <td>{{ $invitado->nombre_invitado }}</td>
                            <td>
                                <span class="rounded bg-gray-500 text-white px-2 py-1 text-sm">
                                    {{ $invitado->numero_invitados }} personas
                                </span>
                            </td>
                            <td>
                                <div class="flex flex-col gap-2">
                                    <button type="button" class="rounded py-1 bg-blue-700 hover:bg-blue-800 text-white btn-edit" data-uuid="{{ $invitado->uuid_invitado }}">Editar</button>
                                    <button type="button" class="rounded py-1 bg-red-700 hover:bg-red-800 text-white btn-delete" data-uuid="{{ $invitado->uuid_invitado }}">Eliminar</button>
                                    <button type="button" class="rounded py-1 bg-violet-700 hover:bg-violet-800 text-white btn-qr" data-uuid="{{ $invitado->uuid_invitado }}" data-nombre-invitado="{{ $invitado->nombre_invitado }}">Generar QR</button>
                                    <button type="button" class="rounded py-1 bg-green-700 hover:bg-green-800 text-white btn-copy" data-clipboard-text="{{ config('app.url_front') . $invitado->uuid_invitado }}">Copiar Url Invitación</button>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            </div>
        </div>
    </section>

    @include('panel.includes.modal-create')
    @include('panel.includes.modal-edit')
    @include('panel.includes.modal-qr')
</main>
@endsection

@section('scripts')
    @vite('resources/js/panel.js')
@endsection
