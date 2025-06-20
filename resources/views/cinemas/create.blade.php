<x-dlayout>
    <x-bg-image :imageUrl="$place->photo">
        <div class="h-60 sm:h-100 flex flex-col justify-end space-y-10">
            <h1>{{ $place->township }}</h1>
            <div>
                <h2>Zuco Cinema [{{ $place->place }}]</h2>
                <p>{{ $place->location }}</p>
            </div>
        </div>
    </x-bg-image>
    <x-mother>
        <h1 class=" font-bold text-4xl mb-8">Add A new Cinema</h1>
        <x-forms.form method="POST" action="/cinemas" enctype="multipart/form-data">
            <x-forms.input label="" name="place_id" hidden :value="$place->id" />
            <x-forms.input label="Name" name="name"/>
            <x-forms.input label="Photo" name="photo" type="file"/>
            <x-forms.divider/>
            <x-forms.button>Create Cinema</x-forms.button>
        </x-forms.form>
    </x-mother>
</x-dlayout>