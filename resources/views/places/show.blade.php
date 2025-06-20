<x-dlayout>
    <x-bg-image :imageUrl="$place->photo">
        <div class="h-100 flex flex-col justify-end space-y-10">
            <h1>{{ $place->township }}</h1>
            <div>
                <h2>Zuco Cinema [{{ $place->place }}]</h2>
                <p>{{ $place->location }}</p>
            </div>
            <a href="/places/{{$place->id}}/edit" class="bg-pink-600 text-white text-sm hover:text-black transition-all duartion-400 hover:px-18 w-auto mr-auto rounded-xl text-bold px-15 py-5 mt-3">Edit Place</a>
        </div>
    </x-bg-image>
    <x-mother>
        <div class="flex flex-col md:flex-row justify-between items-center text-center md:text-left  mb-5 space-y-4 md:space-y-0">
            <h1 class="text-3xl md:text-4xl">Cinemas</h1>
            <div class="flex flex-wrap justify-center md:justify-end gap-2">
                <a href="/cinemas/{{$place->id}}/create"
                class="bg-white/10 p-3 rounded-xl hover:bg-white hover:text-black transition-all duration-300">
                    Create Cinemas
                </a>
            </div>
        </div>
        <div class=" flex flex-col space-y-5">
            @foreach ($cinemas as $cinema)
                    <div class="bg-white/5 hover:bg-black border border-transparent group hover:border-blue-800 transition-all duration-300 w-full overflow-hidden rounded-2xl flex space-x-5"> 
                        <img class="w-25 h-30 sm:w-30 sm:h-40 object-cover" src="{{ asset('storage/' . $cinema->photo) }}" alt="">
    
                        <div class="flex items-center justify-between w-full mr-10">
                            <h1 class=" text-xl sm:text-2xl group-hover:text-blue-800">{{$cinema->name}}</h1>
                            <form method="POST" action="/cinemas/{{ $cinema->id }}" class="mt-4">
                                @csrf
                                @method('DELETE')
                                <button onclick="return confirm('Are you sure you want to delete this movie?')" class="bg-red-600 hover:bg-red-800 cursor-pointer text-white font-bold py-2 px-4 rounded">
                                    <i class="fa-solid fa-trash"></i>
                                </button>
                            </form>
                            
                        </div>
                    </div>
            @endforeach
            
        </div>
    </x-mother>
</x-dlayout>