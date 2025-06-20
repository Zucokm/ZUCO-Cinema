<x-dlayout>
    <x-mother>
        <h1 class="font-bold text-4xl mb-8">{{ $place->name }}</h1>

        <form method="POST" enctype="multipart/form-data" action="/places/{{$place->id}}" class="max-w-2xl mx-auto space-y-6">
            @csrf
            @method('PATCH')    
            
            <x-forms.input label="Township" name="township" :value="$place->township"/>
            <div>
                <label class="block font-semibold text-sm text-gray-200 mb-1">Current Place Image</label>
                <img src="{{ asset('storage/' . $place->photo) }}" alt="Place Image" class="w-40 rounded shadow border border-white/20">
            </div>
            <x-forms.input label="Place's Photo" name="photo" type="file" :value="$place->photo"/>
            <x-forms.input label="Place" name="place"  :value="$place->place"/>
            <x-forms.input label="Location" name="location" :value="$place->location"/>
            

            <x-forms.divider/>
            <x-forms.button>Update Movie</x-forms.button>
        </form>
        <form method="POST" action="/places/{{ $place->id }}" class="mt-4">
            @csrf
            @method('DELETE')
            <button onclick="return confirm('Are you sure you want to delete this movie?')" class="bg-red-600 hover:bg-red-800 text-white font-bold py-2 px-4 rounded">
                Delete Movie
            </button>
        </form>
    </x-mother>
</x-dlayout>