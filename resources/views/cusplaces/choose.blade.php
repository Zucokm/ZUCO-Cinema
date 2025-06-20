<x-layout>
    <div class="p-6 max-w-4xl mx-auto">
        <!-- Cinema Name -->
        <h1 class="text-3xl font-bold mb-4 text-center">
            {{ $cinema->name }}
        </h1>

        <!-- Cinema Location (Optional) -->
        <p class="text-gray-600 mb-6 text-center">
            {{ $cinema->location }}
        </p>

        <!-- Schedule Grouped by Date -->
        @foreach ($schedules as $date => $dailySchedules)
            <div class="mb-6">
                <!-- Date Header -->
                <h2 class="text-xl font-semibold text-blue-700 mb-2">
                    {{ \Carbon\Carbon::parse($date)->format('F j, Y') }}
                </h2>

                <!-- List of Shows on that Date -->
                <ul class="space-y-2">
                    @foreach ($dailySchedules as $schedule)
                        <a href="/cuschooses/{{ $schedule->id }}">
                            <li class="p-4 bg-white/10 border mb-3  overflow-hidden hover:border-blue-800 transition-all duration-300 group border-gray-300 rounded-xl shadow-sm flex flex-col sm:flex-row sm:justify-between sm:items-center gap-4">
                                <!-- Movie Title -->
                                <div class="text-center sm:text-left text-white group-hover:text-blue-500 duration-300 text-lg">
                                    <i class="fa-solid fa-video text-white/50"></i> : {{ $schedule->movie->name ?? 'Unknown Movie' }}
                                </div>
                                <!-- Start Time -->
                                <div class="text-center sm:text-right text-sm text-white">
                                    <i class="fa-solid fa-clock text-white/50"></i> : {{ \Carbon\Carbon::parse($schedule->start)->format('h:i A') }}
                                </div>
                            </li>
                        </a>
                    @endforeach
                </ul>
            </div>
        @endforeach

        <!-- Back Link -->
        <div class="mt-6">
            <a href="/cusplaces/{{$cinema->place->id}}" class="text-blue-600 hover:underline">&larr; Back to Cinemas</a>
        </div>
    </div>
</x-layout>