<x-dlayout>
    <x-mother>
        <h1 class="font-bold text-4xl mb-8">
            Edit Schedule for {{ $schedule->cinema->place->township }} [{{ $schedule->cinema->place->place }}]
        </h1>
        <x-forms.form method="POST" action="/schedules/{{ $schedule->id }}">
            @csrf
            @method('PATCH')

            <input type="hidden" name="place_id" value="{{ $schedule->cinema->place->id }}">

            <x-forms.select label="Select Cinema" name="cinema_id">
                @foreach ($schedule->cinema->place->cinemas as $cinema)
                    <option value="{{ $cinema->id }}" @selected($cinema->id == $schedule->cinema_id)>
                        {{ $cinema->name }}
                    </option>
                @endforeach
            </x-forms.select>

            <x-forms.select label="Select Movie" name="movie_id">
                @foreach ($movies as $movie)
                    <option value="{{ $movie->id }}" @selected($movie->id == $schedule->movie_id)>
                        {{ $movie->name }}
                    </option>
                @endforeach
            </x-forms.select>

            <x-forms.input label="Show Date" name="show_date" type="date" :value="$schedule->show_date" />

            <x-forms.input
                label="Start Time"
                name="start"
                type="time"
                id="start-time"
                :value="\Carbon\Carbon::parse($schedule->start)->format('H:i')"
            />

            <x-forms.input
                label="End Time (Auto +3 hrs)"
                name="end"
                type="time"
                id="end-time"
                :value="\Carbon\Carbon::parse($schedule->end)->format('H:i')"
                readonly
            />

            <x-forms.divider />

            <x-forms.button>Update Schedule</x-forms.button>
        </x-forms.form>
        <form action="/schedules/{{ $schedule->id }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this schedule?');">
            @csrf
            @method('DELETE')
            <x-forms.button class="bg-red-500 hover:bg-red-600 mt-4">
                Delete Schedule
            </x-forms.button>
        </form>
    </x-mother>
</x-dlayout>