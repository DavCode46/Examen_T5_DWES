<x-app-layout>
    <x-slot name='header'>
        <h2 class='font-semibold text-xl text-gray-800 leading-tight'>
            {{ __('Crear Personaje') }}
        </h2>
    </x-slot>

    <div>
        <form action="{{route('personajes.store')}}" method='POST' enctype='multipart/form-data'>
            @csrf
            @if ($errors->any())
                        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4" role="alert">
                            <strong class="font-bold">Oops! Something went wrong.</strong>
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
            <div>
                <label for="nombre">Nombre</label>
                <input type="text" name='nombre' id='nombre' placeholder='Nombre del personaje'>
            </div>
            <div>
                <select name="raza_id" id="raza_id">
                    @foreach($razas as $raza)
                     <option value="{{$raza->id}}">{{$raza->raza}}</option>
                    @endforeach
                </select>
            </div>
            <div>
                <label for="clase">Clase</label>
                <input type="text" name='clase' id='clase' placeholder='Clase del personaje'>
            </div>
            <div>
                <label for="imagen">Imagen</label>
                <input type="file" name="imagen" id="imagen">
            </div>
            <div>
                <label for="habilidades">Habilidades</label>
               <input type="text" name='habilidades' id='habilidades' placeholder='habilidades'>
            </div>

            <button type="submit">Crear Personaje</button>
        </form>
    </div>
</x-app-layout>
