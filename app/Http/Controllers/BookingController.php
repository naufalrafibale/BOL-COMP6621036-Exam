<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Redirect;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;
use App\Models\Transaction;
use App\Models\Room;
use App\Models\User;

class BookingController extends Controller
{
    public function view_room_customer(Request $request): View
    {
        $rooms = Room::all();
        return view('app.customer.booking', [
            'rooms' => $rooms
        ]);
    }

    public function book_room_customer(User $user, Request $request): RedirectResponse
    {
        // $room = 
    }
}
