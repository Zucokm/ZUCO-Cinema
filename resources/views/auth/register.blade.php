<x-layout>
    <x-mother>
        <h1 class=" font-bold text-4xl mb-8">Register</h1>
        <x-forms.form method="POST" action="/register" enctype="multipart/form-data">
            <x-forms.input label="Your Name" name="name"/>
            <x-forms.input label="Email" name="email" type="email"/>
            <x-forms.input label="Password" name="password" type="password"/>
            <x-forms.input label="Password Confirmation" name="password_confirmation" type="password"/>
            <x-forms.divider/>
            <x-forms.button>Create Account</x-forms.button>
        </x-forms.form>
    </x-mother>
</x-layout>