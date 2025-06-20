<x-dlayout>
    @if (request()->is('seattypes'))
        <div class="flex flex-col md:flex-row justify-between items-center text-center md:text-left px-4 md:px-16 py-3 border-b border-white/10 space-y-4 md:space-y-0">
            <h1 class="text-3xl md:text-4xl">Seat Types</h1>
            <div class="flex flex-wrap justify-center md:justify-end gap-2">
            
                @if($seatTypes->count() === 0)
                    <!-- Auto Generate Seat Types Button -->
                    <button onclick="event.preventDefault(); document.getElementById('auto-generate-form').submit();"
                        class="bg-white/10 p-3 rounded-xl hover:bg-white hover:text-black transition-all duration-300">
                        Auto Generate The Seat Types
                    </button>

                    <!-- Hidden Form -->
                    <form id="auto-generate-form" method="POST" action="{{ route('seattypes.autogenerate') }}" class="hidden">
                        @csrf
                    </form>
                @else
                    <!-- Already Generated Message -->
                    <span class="bg-green-700 cursor-no-drop text-white px-4 py-2 rounded-xl">
                        ✅ Seat types already generated
                    </span>
                @endif

            </div>
        </div>
    @endif
    <x-mother>
        @if(session('success'))
            <div 
                x-data="{ show: true }" 
                x-init="setTimeout(() => show = false, 2000)" 
                x-show="show"
                x-transition 
                class="text-green-500 font-semibold px-4 py-2"
            >
                {{ session('success') }}
            </div>
        @endif
        <div class=" flex flex-col rounded-2xl bg-white/5">
            @foreach ($seatTypes as $seatType)
                <a href="/seattypes/{{$seatType->id}}/edit">
                    <div class="group border-b border-white/10 hover:border-blue-800 transition-all px-5 py-4 md:px-10 md:py-5 flex flex-col md:flex-row md:items-center md:justify-between gap-3 md:gap-0 cursor-pointer">

                        <div class="text-lg font-semibold text-white group-hover:text-blue-500">
                            {{ $seatType->name }}
                        </div>

                        <div class="text-white/80 text-base">
                            {{ number_format($seatType->price) }} MMK
                        </div>

                        <form method="POST" action="/seattypes/{{ $seatType->id }}">
                            @csrf
                            @method('DELETE')
                            <button onclick="return confirm('Are you sure you want to delete this seat type?')"
                                class="bg-red-600 hover:bg-red-800 text-white px-4 py-2 rounded-lg font-semibold shadow hover:shadow-lg transition-all duration-200">
                                <i class="fa-solid fa-trash"></i>
                            </button>
                        </form>
    
                    </div>
                </a>
            @endforeach
        </div>
    </x-mother>
</x-dlayout>