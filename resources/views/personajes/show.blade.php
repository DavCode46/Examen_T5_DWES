<x-app-layout>
    <x-slot name='header'>
        <h2 class='font-semibold text-xl text-gray-800 leading-tight'>
            {{ $personaje->nombre }}
        </h2>
    </x-slot>

    <div>

        <div>
            @if ($personaje->imagen)
            <img src="{{ asset(Storage::url($personaje->imagen)) }}" alt="{{ $personaje->nombre }}" class="w-20 h-20 object-cover">
            @else
            <p class="text-gray-900">No hay imagen disponible</p>
            @endif
        </div>

        <div>
            <p><strong>Nombre:</strong> {{ $personaje->nombre }}</p>
            <p><strong>Raza:</strong> {{ $personaje->raza->raza }}</p>
            <p><strong>Clase:</strong> {{ $personaje->clase }}</p>
            <p><strong>Habilidades:</strong> {{ $personaje->habilidades }}</p>
        </div>

        <a href='{{ route('personajes.edit', $personaje) }}' class='bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded'>
            {{ __('Editar') }}
        </a>
        <form action="{{route('personajes.destroy', $personaje->id)}}" method='POST'>
            @csrf
            @method('DELETE')
            <button type='submit' class='bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded'>
                {{ __('Eliminar') }}
            </button>
        </form>

        <a href="{{route('personajes.index')}}" class='bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded'>Volver al inicio</a>

    </div>
</x-app-layout>
