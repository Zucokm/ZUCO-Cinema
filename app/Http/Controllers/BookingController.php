<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreBookingRequest;
use App\Http\Requests\UpdateBookingRequest;
use App\Models\Booking;
use App\Models\Schedule;
use App\Models\Seat;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BookingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = Auth::user();
        $bookings = $user->bookings()->latest()->cursorPaginate(4);
        return view('bookings.index', [
            'user' => $user,
            'bookings' => $bookings,
        ]);
    }
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */


    public function store(Request $request)
    {
        $validated = $request->validate([
            'user_id' => 'required|exists:users,id',
            'schedule_id' => 'required|exists:schedules,id',
            'selected_seats' => 'required|string',
            'price' => 'required|numeric',
            'payment' => 'required|string',
            'booking_date' => 'required|date',
            'quantity' => 'required|integer|min:1',
        ]);


        // Create the booking
        $booking = Booking::create([
            'user_id' => $validated['user_id'],
            'schedule_id' => $validated['schedule_id'],
            'price' => $validated['price'],
            'payment' => $validated['payment'],
            'booking_date' => $validated['booking_date'],
            'quantity' => $validated['quantity']
        ]);

        $seatIds = explode(',', $validated['selected_seats']);


        foreach ($seatIds as $seatId) {
            $seat = Seat::find($seatId);

            if ($seat && !$seat->is_booked) {
                $booking->seats()->attach($seatId);

            }
        }
        return redirect('/bookings')->with('success', 'Your booking is successful!');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $booking = Booking::find($id);
        return view('bookings.show', [
            'booking' => $booking,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Booking $booking)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateBookingRequest $request, Booking $booking)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $booking = Booking::findOrFail($id);
        $booking->seats()->detach(); // Many-to-many relationship clear first
        $booking->delete();

        return redirect()->route('bookings.index')->with('success', 'Booking deleted successfully.');
    }
}
