<x-dlayout>
    <x-mother>
        <h1 class="font-bold text-4xl mb-8">
            Create A New Schedule for {{ $place->township }} [{{ $place->place }}]
        </h1>
        <x-forms.form method="POST" action="/schedules">
            @csrf
            <input type="hidden" name="place_id" value="{{ $place->id }}">

            <x-forms.select label="Select Cinema" name="cinema_id">
                @foreach ($place->cinemas as $cinema)
                    <option value="{{ $cinema->id }}">{{ $cinema->name }}</option>
                @endforeach
            </x-forms.select>

            <x-forms.select label="Select Movie" name="movie_id">
                @foreach ($movies as $movie)
                    <option value="{{ $movie->id }}">{{ $movie->name }}</option>
                @endforeach
            </x-forms.select>

            <x-forms.input label="Show Date" name="show_date" type="date" />

            <x-forms.input label="Start Time" name="start" type="time" id="start-time" />

            <x-forms.input label="End Time (Auto +3 hrs)" name="end" type="time" id="end-time" readonly />

            <x-forms.divider />

            <x-forms.button>Create Schedule</x-forms.button>
        </x-forms.form>
    </x-mother>
</x-dlayout>