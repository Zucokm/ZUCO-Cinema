<x-dlayout>

    @if (request()->is('schedules'))
        <div class="flex flex-wrap justify-between items-center text-center md:text-left px-4 md:px-16 py-3 border-b border-white/10 space-y-4 md:space-y-0">
            <h1 class="text-3xl md:text-4xl">Add Schedules For</h1>

            <div class="w-full scrollbar-hide md:w-auto overflow-x-auto">
                <div class="flex flex-nowrap md:flex-wrap justify-center md:justify-end gap-2  min-w-max">
                    @foreach ($places as $place)
                        <a href="/schedules/{{ $place->id }}/create"
                            class="whitespace-nowrap bg-white/10 p-3 rounded-xl hover:bg-white hover:text-black transition-all duration-300 text-sm md:text-base">
                            {{ $place->township }} [{{$place->place}}]
                        </a>
                    @endforeach
                </div>
            </div>
        </div>
    @endif

        
    <x-mother>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 px-4 md:px-16 py-6">
            @foreach ($places as $place)
                <div class="bg-white/5 rounded-2xl p-4 shadow-md">
                    <h2 class="text-xl md:text-2xl font-bold text-blue-400 mb-4">
                        {{ $place->township }} - {{ $place->place }}
                    </h2>

                    @forelse ($place->cinemas as $cinema)
                        <div class="mb-6 border-b border-white pb-4">
                            <h3 class="text-base md:text-lg text-white font-semibold mb-2 pl-2">
                                <i class="fa-solid fa-building text-white/50"></i>: {{ $cinema->name }}
                            </h3>

                            <!-- Scrollable container for schedule lists  -->
                            <div class="h-96 overflow-y-auto pr-2 custom-scrollbar">
                                @forelse ($cinema->groupedSchedules as $showDate => $schedules)
                                    <div class="mb-4">
                                        <h4 class="text-white/80 text-sm md:text-base font-bold mb-2">
                                            <i class="fa-solid fa-calendar-days text-white/50"></i>: {{ \Carbon\Carbon::parse($showDate)->format('l, F j, Y') }}
                                        </h4>

                                        <div class="overflow-x-auto">
                                            <table class="min-w-full text-xs md:text-sm text-white/90 bg-white/5 border border-white/10 rounded-lg">
                                                <thead class="bg-white/10 text-white text-left">
                                                    <tr>
                                                        <th class="px-4 py-2"><i class="fa-solid fa-video text-white"></i>: Movie</th>
                                                        <th class="px-4 py-2"><i class="fa-solid fa-clock text-white/50"></i>: Start</th>
                                                        <th class="px-4 py-2"><i class="fa-solid fa-clock text-white/50"></i>: End</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach ($schedules as $schedule)
                                                        <tr class="border-t cursor-pointer border-white/10 hover:bg-white/10 transition-colors">
                                                            <td class="px-4 py-2">
                                                                <a href="/schedules/{{$schedule->id}}/edit" class="block w-full h-full text-white no-underline"> {{-- Add styling to make it look like part of the table --}}
                                                                    {{ $schedule->movie->name }}
                                                                </a>
                                                            </td>
                                                            <td class="px-4 py-2">
                                                                <a href="/schedules/{{$schedule->id}}/edit" class="block w-full h-full text-white no-underline">
                                                                    {{ \Carbon\Carbon::parse($schedule->start)->format('h:i A') }}
                                                                </a>
                                                            </td>
                                                            <td class="px-4 py-2">
                                                                <a href="/schedules/{{$schedule->id}}/edit" class="block w-full h-full text-white no-underline">
                                                                    {{ \Carbon\Carbon::parse($schedule->end)->format('h:i A') }}
                                                                </a>
                                                            </td>
                                                        </tr>
                                                    @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                @empty
                                    <p class="text-white/50 pl-4">No schedules available.</p>
                                @endforelse
                            </div>
                        </div>
                    @empty
                        <p class="text-white/50">No cinemas found in this place.</p>
                    @endforelse
                </div>
            @endforeach
        </div>

    </x-mother>
</x-dlayout>