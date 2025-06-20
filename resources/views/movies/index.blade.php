<x-dlayout>
    <x-mother>
        <div class="flex flex-col space-y-6 my-10 px-4">
        @foreach ($movies as $movie)
            <a href="/movies/{{$movie->id}}">
                <div class="flex flex-col md:flex-row bg-white/5 overflow-hidden rounded-2xl  group hover:border-blue-800 transition-all duration-300 shadow-lg ">
                    {{-- Movie Poster --}}
                    <img class="w-full md:w-48 h-auto object-cover" src="{{ asset('storage/' . $movie->image) }}" alt="Movie Poster">

                    {{-- Movie Details --}}
                    <div class="p-4 flex flex-col justify-between space-y-2 text-sm md:text-base w-full">
                        <div>
                            <h2 class="text-xl font-semibold mb-1 group-hover:text-blue-800 transition-all duration-300">{{ $movie->name }}</h2>
                            <p><span class="font-medium text-white/80">Type:</span> {{ $movie->type }}</p>
                            <p><span class="font-medium text-white/80">Likes:</span> {{ $movie->like }}</p>
                            <p><span class="font-medium text-white/80">Director:</span> {{ $movie->director }}</p>
                            <p><span class="font-medium text-white/80">Duration:</span> {{ $movie->duration }} min</p>
                            <p><span class="font-medium text-white/80">Rating:</span> {{ $movie->rating }}/10</p>
                            <p><span class="font-medium text-white/80">Language:</span> {{ $movie->language }}</p>
                        </div>
                    </div>
                </div>
            </a>
        @endforeach
    </div>
    </x-mother>
</x-dlayout>