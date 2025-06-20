<x-dlayout>
    <x-mother>
        <h1 class="font-bold text-4xl mb-8">{{ $movie->name }}</h1>

        <form method="POST" enctype="multipart/form-data" action="/movies/{{$movie->id}}" class="max-w-2xl mx-auto space-y-6">
            @csrf
            @method('PATCH')    
            
            <x-forms.input label="Movie Name" name="name" :value="$movie->name"/>
            <x-forms.input label="Description" name="description" :value="$movie->description"/>
            <x-forms.input label="Like" name="like" :value="$movie->like"/>
            <div>
                <label class="block font-semibold text-sm text-gray-200 mb-1">Current Movie Image</label>
                <img src="{{ asset('storage/' . $movie->image) }}" alt="Movie Image" class="w-40 rounded shadow border border-white/20">
            </div>
            <x-forms.input label="Movie Image" name="image" type="file" :value="$movie->image"/>
            <x-forms.input label="Duration" name="duration" type="number" :value="$movie->duration"/>
            <x-forms.input label="Director" name="director" :value="$movie->director"/>
           <div>
                <label class="block font-semibold text-sm text-gray-200 mb-1">Current Background Image</label>
                <img src="{{ asset('storage/' . $movie->bgImage) }}" alt="Background Image" class="w-40 rounded shadow border border-white/20">
            </div>
            <x-forms.input label="Back Ground Image" name="bgImage" type="file" :value="$movie->bgImage"/>
            <x-forms.input label="Type" name="type" :value="$movie->type"/>
            <x-forms.input label="Trailer URL" name="trailer" :value="$movie->trailer"/>
            <x-forms.input label="Rating" name="rating" type="number" :value="$movie->rating"/>
            <x-forms.input label="Language" name="language" :value="$movie->language"/>

            <x-forms.divider/>
            <x-forms.button>Update Movie</x-forms.button>
        </form>
        <form method="POST" action="/movies/{{ $movie->id }}" class="mt-4">
            @csrf
            @method('DELETE')
            <button onclick="return confirm('Are you sure you want to delete this movie?')" class="bg-red-600 hover:bg-red-800 text-white font-bold py-2 px-4 rounded">
                Delete Movie
            </button>
        </form>
    </x-mother>
</x-dlayout>