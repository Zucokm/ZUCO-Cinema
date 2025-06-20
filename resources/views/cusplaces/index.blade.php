<x-layout>
    <x-mother>
        <div class=" space-y-10">
            <x-section>
                <x-section-heading>Zuco Cinemas</x-section-heading>
                <x-card-body>
                    @foreach ($places as $place)
                        <x-place-card-wide :$place></x-place-card-wide>
                    @endforeach
                </x-card-body>
            </x-section>
        </div>
    </x-mother>
      
</x-layout>