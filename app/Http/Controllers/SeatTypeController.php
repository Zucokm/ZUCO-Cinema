<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreSeatTypeRequest;
use App\Http\Requests\UpdateSeatTypeRequest;
use App\Models\SeatType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class SeatTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $seatTypes = SeatType::all();
        return view('seattypes.index', [
            'seatTypes' => $seatTypes,
        ]);
    }

    public function autoGenerate()
    {
        $seatTypes = [
            ['id' => 1, 'name' => 'Regular',  'price' => 3000],
            ['id' => 2, 'name' => 'Premium',  'price' => 5000],
            ['id' => 3, 'name' => 'VIP',      'price' => 7000],
            ['id' => 4, 'name' => 'Couple',   'price' => 8000],
            ['id' => 5, 'name' => 'Recliner', 'price' => 9000],
        ];

        foreach ($seatTypes as $type) {
            SeatType::updateOrCreate(['id' => $type['id']], $type);
        }

        return redirect()->back()->with('success', 'Seat types generated successfully.');
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
    public function store(StoreSeatTypeRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(SeatType $seatType)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {

        $seatType = SeatType::find($id);

        return view('seattypes.edit', [
            'seatType' => $seatType
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
   public function update($id)
    {

        $seatType = SeatType::find($id);
        $seatTypeAttributes = request()->validate([
            'name' => ['required'],
            'price' => ['required'],
        ]);

        $seatType->update($seatTypeAttributes);

        return redirect('/seattypes')->with('success', 'Seat type updated successfully.');
    }
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(SeatType $seatType)
    {
    $seatType->delete();

    return redirect("/seattypes")->with('success', 'Cinema deleted successfully.');
    }
}
