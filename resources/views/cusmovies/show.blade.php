
<x-layout>
    <x-bg-image :imageUrl="$movie->bgImage">
        <a href="{{$movie->trailer}}" target="_blank">
            <div class="w-60 md:w-62 bg-white/10 cursor-pointer rounded-xl shrink-0 border border-transparent hover:border-blue-800 group transition-all duration-300 h-full flex justify-between flex-col">
                <div>
                    <img class="rounded-t-xl w-full h-auto" src="{{ asset('storage/' . $movie->image) }}"  alt="Movie">
                </div>
                <div class="text-2xs text-center text-black sm:text-sm p-1 border-t rounded-b-xl group-hover:bg-black group-hover:text-white bg-white/50 duration-300 ">trailer</div>
            </div>
        </a>
        
        <div class="pt-10 flex flex-col space-y-4">
            <h1 class=" text-4xl">{{$movie->name}}</h1>
            <div class="bg-gray-600 px-6 py-5 rounded-xl flex justify-between w-60 md:w-100  text-xl">
                <div class="flex text-center space-x-1 my-auto items-center">
                    <i class="fa-solid fa-star text-pink-600"></i>
                    <p>{{$movie->rating}}/10 (Global)</p>
                </div>
                <a href="https://www.imdb.com/" target="_blank" class=" my-auto px-0 sm:px-2 py-0 sm:py-1 bg-white rounded-sm sm:rounded-xl text-black hover:bg-black hover:text-white transition-all duration-300">
                    Search
                </a>
            </div>
            <span class="bg-white/80 w-auto mr-auto text-sm rounded-xl text-black px-3 py-2 mt-3"> {{$movie->language}}</span>
            <div class=" text-xl">
                <span>{{$movie->duration}} Mins. /</span>
                <span> {{$movie->type}}</span>
            </div>
            <a href="/cusschedules/{{$movie->id}}" class="bg-pink-600 text-white text-sm hover:text-black transition-all duartion-400 hover:px-18 w-auto mr-auto rounded-xl text-bold px-15 py-5 mt-3">Book tickets</a>
        </div>
    </x-bg-image>
    <x-mother>
        <x-section>
            <x-section-heading>About the movie</x-section-heading> 
        </x-section>
        <p class=" mb-10 w-70 sm:w-150">
            {{$movie->description}}
        </p>
    </x-mother>
</x-layout>