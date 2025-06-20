

<x-layout>
    <x-bg-image :imageUrl="$place->photo">
        <div class="h-60 sm:h-100 flex flex-col justify-end space-y-10">
            <h1>{{ $place->township }}</h1>
            <div>
                <h2>Zuco Cinema [{{ $place->place }}]</h2>
                <p>{{ $place->location }}</p>
            </div>
        </div>
    </x-bg-image>
    <x-mother>
        <h1 class=" text-3xl mb-10">Theatres</h1>
        <div class=" flex flex-col space-y-5">
            @foreach ($cinemas as $cinema)
                <a href="/choosecinema/{{$cinema->id}}">
                    <div class="bg-white/5 hover:bg-black cursor-pointer border border-transparent group hover:border-blue-800 transition-all duration-300 w-full overflow-hidden rounded-2xl flex space-x-5"> 
                        <img class="w-25 h-30 sm:w-30 sm:h-40 object-cover" src="{{ asset('storage/' . $cinema->photo) }}" alt="">
    
                        <div class="flex items-center justify-center">
                            <h1 class=" text-xl sm:text-2xl group-hover:text-blue-800">{{$cinema->name}}</h1>
                        </div>
                    </div>
                </a>
            @endforeach
            
        </div>
    </x-mother>
</x-layout>