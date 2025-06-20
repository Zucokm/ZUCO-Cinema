
<x-layout>
    <x-slide></x-slide>
    <x-mother>
        <div class=" space-y-10">
            <section class=" text-center mt-10 mb-5">
                <h1 class=" font-bold text-4xl">Let's Find Your Next Movie</h1>
                <form action="" class="mt-6">
                    <input type="text" placeholder="Star War..." class=" rounded-xl bg-white/5 border-white/10 px-5 py-4 w-full max-w-xl">
                </form>
            </section>

            <x-section>
                <x-section-heading>Recommended Movies</x-section-heading>
                <x-scroll-card-body>
                    @foreach ($movies as $movie)
                        <x-movie-card :$movie></x-movie-card>
                    @endforeach
                </x-scroll-card-body>
            </x-section>

            <x-section>
                <x-section-heading>Cinemas</x-section-heading>
                <x-scroll-card-body>                
                    @foreach ($places as $place)
                        <x-place-card :$place></x-place-card>
                    @endforeach
                </x-scroll-card-body>
            </x-section>
        </div>  
    </x-mother>
</x-layout>