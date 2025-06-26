@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-8">
    <h1 class="text-2xl font-bold mb-6">Solicitudes de Negocios Pendientes</h1>

    @if(session('success'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4" role="alert">
            <span class="block sm:inline">{{ session('success') }}</span>
        </div>
    @endif

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        @forelse ($negocios as $negocio)
            <div class="bg-white shadow-lg rounded-lg overflow-hidden">
                @if($negocio->imagen_portada)
                    <img class="w-full h-48 object-cover" src="{{ $negocio->imagen_portada }}" alt="Imagen de portada de {{ $negocio->nombre_negocio }}">
                @else
                    <div class="w-full h-48 bg-gray-200 flex items-center justify-center text-gray-500">
                        No hay imagen de portada
                    </div>
                @endif
                <div class="p-6">
                    <h2 class="text-xl font-semibold text-gray-800 mb-2">{{ $negocio->nombre_negocio }}</h2>
                    <p class="text-gray-600 text-sm mb-4">{{ Str::limit($negocio->descripcion, 100) }}</p>

                    <div class="mb-4">
                        <p class="text-gray-700 text-sm"><strong class="font-medium">Propietario:</strong> {{ $negocio->usuario->name }}</p>
                        <p class="text-gray-700 text-sm"><strong class="font-medium">Ubicación:</strong> {{ $negocio->ubicacion->direccion }}, {{ $negocio->ubicacion->ciudad }}</p>
                        <p class="text-gray-700 text-sm"><strong class="font-medium">Estado Actual:</strong> 
                            <span class="{{ $negocio->verificado ? 'text-green-500' : 'text-red-500' }}">
                                {{ $negocio->verificado ? 'Aprobado' : 'Pendiente' }}
                            </span>
                        </p>
                    </div>

                    <div class="flex justify-between items-center mt-4">
                        <a href="{{ route('admin.negocios.show', $negocio) }}" class="text-blue-600 hover:text-blue-800 font-medium">Ver Detalles</a>
                        <div class="flex space-x-2">
                            <form action="{{ route('admin.negocios.update', $negocio) }}" method="POST" class="inline-block">
                                @csrf
                                @method('PATCH')
                                <input type="hidden" name="estado" value="1">
                                <button type="submit" class="bg-green-500 hover:bg-green-600 text-white font-bold py-2 px-4 rounded-lg text-sm">Aprobar</button>
                            </form>
                            <form action="{{ route('admin.negocios.update', $negocio) }}" method="POST" class="inline-block">
                                @csrf
                                @method('PATCH')
                                <input type="hidden" name="estado" value="0">
                                <button type="submit" class="bg-red-500 hover:bg-red-600 text-white font-bold py-2 px-4 rounded-lg text-sm">Rechazar</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        @empty
            <div class="col-span-full bg-white shadow-lg rounded-lg p-6 text-center text-gray-600">
                No hay solicitudes de negocios pendientes.
            </div>
        @endforelse
    </div>
</div>
@endsection
