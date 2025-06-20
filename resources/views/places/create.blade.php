<x-dlayout>
    <x-mother>
        <h1 class=" font-bold text-4xl mb-8">Create A new Place</h1>
        <x-forms.form method="POST" action="/places" enctype="multipart/form-data">
            <x-forms.input label="Township" name="township"/>
            <x-forms.input label="Photo" name="photo" type="file"/>
            <x-forms.input label="Place" name="place"/>
            <x-forms.input label="Location" name="location" />
            <x-forms.divider/>
            <x-forms.button>Create Place</x-forms.button>
        </x-forms.form>
    </x-mother>
</x-dlayout>