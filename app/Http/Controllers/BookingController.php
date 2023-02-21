<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Redirect;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;
use App\Models\Transaction;
use App\Models\Room;
use App\Models\User;
use App\Models\Customer;

class BookingController extends Controller
{
    public function book(Request $request): RedirectResponse
    {
        $customer = Customer::where('user_id', $request->user()->id)->first();
        $room = Room::find($request->room_id);

        $transaction_price = $room->price_per_night * $request->nights;
        $transaction = Transaction::create([
            'price' => $transaction_price,
            'booked_nights' => $request->nights,
            'booked_start_date' => $request->start_date,
            'booked_end_date' => $request->end_date,
            'customer_id' => $customer->id,
            'room_id' => $room->id,
        ])
    }
}
