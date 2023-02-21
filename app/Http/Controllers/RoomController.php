<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Redirect;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;
use App\Models\Transaction;
use App\Models\Room;

class RoomController extends Controller
{
    public function view_manager(Request $request): View
    {
        $rooms = Room::all()->sortBy('name');
        return view('app.room-management', [
            'rooms' => $rooms]);
    }

    public function view_customer(Request $request): View
    {
        $rooms = Room::all()->sortBy('name');
        return view('app.customer.hotel-rooms', [
            'rooms' => $rooms]);
    }

    public function add(Request $request): RedirectResponse
    {      
        $room = Room::create([
            'name' => $request->name,
            'type' => $request->type,
            'price_per_night' => $request->price_per_night,
            'available_rooms' => $request->available_rooms,
            'booked_rooms' => $request->booked_rooms,
        ]);

        return redirect()->back();
    }

    public function update(Request $request): RedirectResponse
    {
        $room = Room::find($request->id);
        $room->name = $request->name;
        $room->type = $request->type;
        $room->price_per_night = $request->price_per_night;
        $room->available_rooms = $request->available_rooms;
        $room->booked_rooms = $request->booked_rooms;
        $room->save();

        return redirect()->back();
    }

    public function destroy($room_id): RedirectResponse
    {
        $room = Room::find($room_id);
        $item->delete();
        
        return redirect()->back();
    }
}
