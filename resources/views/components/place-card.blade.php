@props(['place'])

<a href="/cusplaces/{{$place->id}}">
    <div class="w-60 sm:w-74 md:w-84 bg-white/5 rounded-xl shrink-0 border border-transparent hover:border-blue-800 group transition-all duration-300">
        <img class="rounded-t-xl h-50 w-full" src="{{ asset('storage/' . $place->photo) }}" alt="location">
        <div class="font-bold text-sm sm:text-base text-center">{{$place->township}}</div>
        <div class="text-xs sm:text-sm text-center pb-1 group-hover:text-blue-800 transition-all duration-300">ZUCO Cinema[{{$place->place}}]</div>
    </div>
</a>