@props(['movie'])

<a href="/cusmovies/{{$movie->id}}">
    <div class="w-30 sm:w-44 md:w-48 bg-white/5 rounded-xl shrink-0 border border-transparent hover:border-blue-800 group transition-all duration-300 h-full flex justify-between flex-col">
        <div>
            <img class="rounded-t-xl w-full h-auto" src="{{ asset('storage/' . $movie->image) }}" alt="Movie">
            <div class="bg-gray-900 p-0.5  space-x-0.5 text-sm">
                <i class="fa-solid fa-heart"></i>
                <span class="text-2xs sm:text-base">{{$movie->like}} Likes</span>
            </div>
        </div>
        <div class="font-bold text-2xs sm:text-base pl-1 group-hover:text-blue-800 transition-all duration-300">{{$movie->name}}</div>
        <div class="text-2xs sm:text-sm p-1 border-t border-white/15 overflow-hidden whitespace-nowrap text-ellipsis">
            {{$movie->type}}
        </div>
        
    </div>
</a>