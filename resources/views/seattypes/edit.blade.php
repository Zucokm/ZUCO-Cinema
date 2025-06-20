<x-dlayout>
    <x-mother>
        <h1 class="font-bold text-4xl mb-8">{{ $seatType->name }}</h1>

        <form method="POST" action="/seattypes/{{$seatType->id}}" class="max-w-2xl mx-auto space-y-6">
            @csrf
            @method('PATCH')    
            
            <x-forms.input label="Seat Type" name="name" :value="$seatType->name"/>
            <x-forms.input label="Price (MMK)" name="price"  :value="$seatType->price"/>

            <x-forms.divider/>
            <x-forms.button>Update Movie</x-forms.button>
        </form>

    </x-mother>
</x-dlayout>