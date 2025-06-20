<?php

namespace App\Http\Controllers;

use App\Models\Schedule;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CuschooseController extends Controller
{
    
    public function show($id)
    {
        $user = Auth::user();
        $schedule = Schedule::find($id);
        $cinema = $schedule->cinema;
        $seats = $cinema->seats->groupBy('seat_type_id');
        $bookings = $schedule->bookings;
        $bookSeats = [];

        foreach ($bookings as $booking) {
            $bookingSeats = $booking->seats;
            foreach ($bookingSeats as $bookingSeat) {
                if ($bookingSeat->id) {
                    $bookSeats[] = $bookingSeat->id; // Get seat number
                }
            }
        }

        return view('cuschooses.show', [
            'schedule' => $schedule,
            'cinema' => $cinema,
            'seats' => $seats,
            'bookSeats' => $bookSeats,
            'user' => $user,
        ]);
    }
}


