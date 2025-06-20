@props(['imageUrl'])

<div class="relative h-auto w-full bg-cover bg-center"
     style="background-image: url('{{ asset('storage/' . $imageUrl) }}');">
    <div class="absolute inset-0 bg-black/20 "></div>
    <div class="relative z-10 flex space-x-8 h-full flex-wrap text-white text-2xl font-semibold px-4 sm:px-10 md:px-20 lg:px-32 xl:px-52 py-6 sm:py-5 transition-all duration-300">
        {{ $slot }}
    </div>
</div>