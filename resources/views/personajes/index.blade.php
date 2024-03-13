<x-app-layout>
    <x-slot name='header'>
        <h2 class='font-semibold text-xl text-gray-800 leading-tight'>
            {{ __('Personajes') }}
        </h2>

        <a href='{{ route('personajes.create') }}' class='bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded'>
            {{ __('Crear Personaje') }}
        </a>

        <div>
            @if($personajes->count())
            <table>
                <thead>
                    <tr>
                        <th>Imagen</th>
                        <th>Nombre</th>
                        <th>Raza</th>
                        <th>Clase</th>
                        <th>Habilidades</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($personajes as $personaje)
                    <tr>
                        <td>
                            @if ($personaje->imagen)
                            <img src="{{ asset(Storage::url($personaje->imagen)) }}" alt="{{ $personaje->nombre }}" class="w-20 h-20 object-cover">
                            @else
                            <p class="text-gray-900">No hay imagen disponible</p>
                            @endif
                        </td>
                        <td>{{ $personaje->nombre }}</td>
                        <td>{{ $personaje->raza->raza }}</td>
                        <td>{{ $personaje->clase }}</td>
                        <td>
                            {{$personaje->habilidades}}
                        </td>
                        <td>
                            <a href='{{ route('personajes.show', $personaje) }}' class='bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded'>
                                {{ __('Ver') }}
                            </a>
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
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            @else
            <p>No hay personajes disponibles</p>
            @endif
        </div>
    </x-slot>
</x-app-layout>
