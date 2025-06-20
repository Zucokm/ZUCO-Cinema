<x-dlayout>
    <x-mother>
        <h1 class=" font-bold text-4xl mb-8">Create A new Movie</h1>
        <x-forms.form method="POST" action="/movies" enctype="multipart/form-data">
            <x-forms.input label="Movie Name" name="name"/>
            <x-forms.input label="Description" name="description"/>
            <x-forms.input label="Like" name="like"/>
            <x-forms.input label="Movie Image" name="image" type="file"/>
            <x-forms.input label="Duration" name="duration" type="number"/>
            <x-forms.input label="Director" name="director"/>
            <x-forms.input label="Back Ground Image" name="bgImage" type="file"/>
            <x-forms.input label="Type" name="type"/>
            <x-forms.input label="Trailer URL" name="trailer"/>
            <x-forms.input label="Rating" name="rating" type="number"/>
            <x-forms.input label="Language" name="language"/>
            <x-forms.divider/>
            <x-forms.button>Create Movie</x-forms.button>
        </x-forms.form>
    </x-mother>
</x-dlayout>