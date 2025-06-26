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
            <div class="bg-white rounded-lg shadow-md overflow-hidden transition-all duration-300 hover:shadow-lg">
                @if($negocio->imagen_portada)
                    <img class="w-full h-48 object-cover" src="{{ $negocio->imagen_portada }}" alt="Imagen de portada de {{ $negocio->nombre_negocio }}">
                @else
                    <div class="w-full h-48 bg-gray-100 flex items-center justify-center text-gray-400 text-sm">
                        Sin imagen
                    </div>
                @endif
                <div class="p-5">
                    <h2 class="text-xl font-semibold text-gray-800 mb-2">{{ $negocio->nombre_negocio }}</h2>
                    <p class="text-gray-600 text-sm mb-4">{{ Str::limit($negocio->descripcion, 80) }}</p>

                    <div class="space-y-2 text-sm text-gray-700 mb-4">
                        <div class="flex items-center">
                            <x-icons.outline.user class="w-4 h-4 mr-2 text-gray-500" />
                            <span>{{ $negocio->usuario->name }}</span>
                        </div>
                        <div class="flex items-center">
                            <x-icons.outline.location-marker class="w-4 h-4 mr-2 text-gray-500" />
                            <span>{{ $negocio->ubicacion->direccion }}, {{ $negocio->ubicacion->ciudad }}</span>
                        </div>
                        <div class="flex items-center">
                            <x-icons.outline.check-circle class="w-4 h-4 mr-2 {{ $negocio->verificado ? 'text-green-500' : 'text-red-500' }}" />
                            <span class="{{ $negocio->verificado ? 'text-green-600' : 'text-red-600' }} font-medium">
                                {{ $negocio->verificado ? 'Aprobado' : 'Pendiente' }}
                            </span>
                        </div>
                    </div>

                    <div class="flex justify-between items-center mt-4 pt-4 border-t border-gray-100">
                        <a href="{{ route('admin.negocios.show', $negocio) }}" class="text-blue-600 hover:text-blue-800 font-medium text-sm flex items-center">
                            Ver Detalles
                            <svg class="w-3 h-3 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
                        </a>
                        <div class="flex space-x-2">
                            <form action="{{ route('admin.negocios.update', $negocio) }}" method="POST">
                                @csrf
                                @method('PATCH')
                                <input type="hidden" name="estado" value="1">
                                <button type="submit" class="bg-green-500 hover:bg-green-600 text-white font-bold py-2 px-3 rounded-md text-xs">Aprobar</button>
                            </form>
                            <form action="{{ route('admin.negocios.update', $negocio) }}" method="POST">
                                @csrf
                                @method('PATCH')
                                <input type="hidden" name="estado" value="0">
                                <button type="submit" class="bg-red-500 hover:bg-red-600 text-white font-bold py-2 px-3 rounded-md text-xs">Rechazar</button>
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