
<x-dlayout>
        <x-mother>
        <h1 class=" font-bold text-4xl mb-8">Admin Register</h1>
        <x-forms.form method="POST" action="/aregister" enctype="multipart/form-data">
            <x-forms.input label="Staff Name" name="name"/>
            <x-forms.input label="Staff NRC" name="NRC"/>
            <x-forms.input label="Email" name="email" type="email"/>
            <x-forms.input label="Password" name="password" type="password"/>
            <x-forms.input label="Password Confirmation" name="password_confirmation" type="password"/>
            <x-forms.input label="Staff Photo" name="photo" type="file"/>

            <x-forms.divider/>
            <x-forms.button>Create Account</x-forms.button>
        </x-forms.form>
    </x-mother>
</x-dlayout>


