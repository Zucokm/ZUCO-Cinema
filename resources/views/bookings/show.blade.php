<x-layout>
    <div class="max-w-2xl mx-auto bg-white/10 p-6 rounded-xl shadow text-white">
        <h2 class="text-2xl font-semibold mb-4">Booking Detail</h2>

        <div class="space-y-3">
            <p>
                <i class="fa-solid fa-video text-white/50"></i> : <strong>Movie:</strong> {{ $booking->schedule->movie->name ?? 'Unknown Movie' }}
            </p>
            <p>
                <i class="fa-solid fa-building text-white/50"></i> : <strong>Cinema:</strong> {{ $booking->schedule->cinema->name ?? 'Unknown Cinema' }}
            </p>
            <p>
                <i class="fa-solid fa-calendar-days text-white/50"></i> : <strong>Date:</strong> {{ \Carbon\Carbon::parse($booking->schedule->show_date)->format('M d, Y') }}
            </p>
            <p>
                <i class="fa-solid fa-image text-white/50"></i> : <strong>Time:</strong> {{ \Carbon\Carbon::parse($booking->schedule->start)->format('h:i A') }}
            </p>
            <p>
                <i class="fa-solid fa-chair text-white/50"></i> : <strong>Seats:</strong> 
                {{ $booking->seats->pluck('seat_number')->join(', ') }}
            </p>
            <p>
                <i class="fa-solid fa-credit-card text-white/50"></i> : <strong>Payment:</strong> {{ $booking->payment ?? 'Pending' }}
            </p>
            <p>
                <i class="fa-solid fa-money-bill text-white/50"></i> : <strong>Total Price:</strong> ${{ number_format($booking->price, 2) }}
            </p>
        </div>

        <div class="mt-6">
            <a href="{{ route('bookings.index') }}" class="text-blue-400 hover:underline">← Back to Bookings</a>
        </div>
        <form action="{{ route('bookings.destroy', $booking->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this booking?');" class="mt-6">
            @csrf
            @method('DELETE')
            <button type="submit" class="px-4 py-2 cursor-pointer bg-red-600 hover:bg-red-700 text-white rounded shadow transition">
                <i class="fa-solid fa-trash"></i> : Delete Booking
            </button>
        </form>
    </div>
</x-layout>