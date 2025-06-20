@props(['place'])

<a href="/cusplaces/{{$place->id}}"  class=" w-full block">
    <div class="w-full bg-white/10 rounded-xl border border-transparent hover:border-blue-800 group transition-all duration-300">
        <img class="rounded-t-xl w-full h-100" src="{{ asset('storage/' . $place->photo) }}" alt="location">
        <div class="font-bold text-sm sm:text-base text-center">{{$place->township}}</div>
        <div class="text-xs sm:text-sm text-center pb-1 group-hover:text-blue-800 transition-all duration-300">
            ZUCO Cinema[{{$place->place}}]
        </div>
    </div>
</a>
