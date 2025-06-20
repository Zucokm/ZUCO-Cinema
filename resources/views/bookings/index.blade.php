<x-layout>

@if(session('success'))
    <div 
    x-data="{ show: true }" 
    x-init="setTimeout(() => show = false, 3000)" 
    x-show="show" 
    x-transition:leave="transition ease-in duration-300 transform" 
    x-transition:leave-start="opacity-100 translate-x-0" 
    x-transition:leave-end="opacity-0 translate-x-10"
    class="mb-4 px-4 py-3 rounded bg-green-100 text-green-900 border border-green-300 shadow"
>
    ✅ {{ session('success') }}
</div>
@endif
<div class="max-w-4xl mx-auto py-8 px-4">
    <h1 class="text-2xl font-bold mb-6 text-white">My Bookings</h1>
        @if($bookings->count() > 0)
            <ul class="space-y-4">
            @foreach($bookings as $booking)
                    <li class="p-4 bg-white/10 border border-gray-300 rounded-xl shadow hover:border-blue-700 transition-all">
                        <a href="/bookings/{{$booking->id}}" class="block">
                            <div class="flex flex-col sm:flex-row justify-between sm:items-center gap-3">
                                <div class="text-white">
                                    <i class=" text-white/50 fa-solid fa-video"></i>
                                    <strong>{{ $booking->schedule->movie->name ?? 'Unknown Movie' }}</strong><br>
                                    <i class=" text-white/50 fa-solid fa-building"></i>
                                    Cinema: {{ $booking->schedule->cinema->name ?? 'Unknown Cinema' }}<br>
                                    <i class="text-white/50 fa-solid fa-calendar-days"></i>
                                    Date: {{ \Carbon\Carbon::parse($booking->schedule->show_date)->format('M d, Y') }}<br>
                                    <i class="text-white/50 fa-solid fa-clock"></i>
                                    Time: {{ \Carbon\Carbon::parse($booking->schedule->start)->format('h:i A') }}
                                </div>
                                <div class=" text-pink-600 text-center ">
                                    Booking Date <br>{{ $booking->booking_date}}
                                </div>
                                <div class="text-blue-400 text-sm">
                                    <i class="fa-solid fa-chair"></i>
                                    Seats: {{ $booking->quantity }}<br>
                                    <i class="fa-solid fa-credit-card"></i>
                                    Payment: {{ $booking->payment ?? 'Pending' }}
                                </div>
                            </div>
                        </a>
                    </li>
                @endforeach
            </ul>
            <div class="mt-6">
        {{ $bookings->links() }}
    </div>
        @else
            <p class="text-gray-300">No bookings found.</p>
        @endif
</div>

</x-layout>
