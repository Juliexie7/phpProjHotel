<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\hotel;
use App\Models\reservation;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use DateTimeZone;
use Illuminate\Support\Facades\Date;

class HotelController extends Controller
{
    public function index()
    {
        $hotels = hotel::all();
        return view('welcome', compact('hotels'));
    }

    public function reserve($hotel_id)
    {
        $hotel = DB::table('hotels')->where('hotel_id', $hotel_id)->first();
        return view('reservation',compact('hotel'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, $hotel_id){
        $maxcheckout = Carbon::now()->addDays(10)->format('Y-m-d');
        $this->validate($request,[
            'checkin' => 'required|date|after_or_equal:today',
            'checkout' => 'required|date|after:checkin|before_or_equal:'.$maxcheckout,
            'name' => 'required',
            'email' => 'email:rfc,dns',
            'phone' => 'required',
            'addInfo' => 'max:255'
           ]);

           
        $text = trim($request->addInfo);
        $text = stripslashes($text); 
        $text = htmlspecialchars($text);

        $Reservation = new Reservation;
        $Reservation->user_id = 1;
        $Reservation->room_type_id = $request->roomtype;
        $Reservation->number_booked = 1;
        $Reservation->checkin = $request->checkin;
        $Reservation->checkout = $request->checkout;
        $Reservation->name = $request->name;
        $Reservation->email = $request->email;
        $Reservation->phone = $request->phone;
        $Reservation->addinfo = $text;

        $Reservation->save();

        $checkout = Carbon::create($request->checkout, new DateTimeZone('America/Toronto'))->subDay()->format('Y-m-d');
        $affected = DB::table('room_days')
              ->whereRaw('room_type_id = ? and hotel_id = ? and date between ? and ?', [$request->roomtype, $hotel_id, $request->checkin, $checkout])
              ->update(['available' => DB::raw('available-1')]);

        return redirect(route('hotel'))->with('successMsg','Reservation Successfully Added');
    }

    public function roomavailable(string $hotel_id, string $checkin, string $checkout)
    {
        // $query = "select * from myTable";
        // $results = DB::connection('myDB')->select($query);
        // $results = DB::query($query);

        $room_days = DB::table('room_days')
            ->select('room_type_id', DB::raw('min(available) as available'))
            ->whereRaw('hotel_id = ? and date >= ? and date < ?', [$hotel_id, $checkin, $checkout])
            ->groupBy('room_type_id')
            ->get();

        return response()
            ->json($room_days);  // ->json(['name' => 'Abigail', 'state' => 'CA'])
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
