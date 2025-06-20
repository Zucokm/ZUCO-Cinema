<x-layout>
    <x-mother>
        <div class=" border-b-1 pb-3 mb-5">
            <a href="/cusmovies/{{$movie->id}}" class="text-4xl hover:underline">
                    {{$movie->name}} - ( {{$movie->language}} )
            </a>
            <p>
                {{$movie->type}}
            </p>
        </div>
        @foreach ($schedulesByDate as $date => $schedules)
            <div class="mb-6">
                <h2 class="text-xl font-semibold mb-2">Date: {{ \Carbon\Carbon::parse($date)->format('F j, Y') }}</h2>
                <ul class="space-y-2 pl-4">
                    @foreach ($schedules as $schedule)

                        <a href="/cuschooses/{{$schedule->id}}">
                            <li class="bg-white/10 p-3 rounded shadow hover:p-5 transition-all duration-500 hover:text-pink-700 mb-1">
                                Time: {{ $schedule->start }} | Cinema: {{ $schedule->cinema->name ?? 'N/A' }} | ( {{$schedule->cinema->place->township}}/{{$schedule->cinema->place->place}} )
                            </li>
                        </a>
                        
                    @endforeach
                </ul>
            </div>
        @endforeach
    </x-mother>
</x-layout>