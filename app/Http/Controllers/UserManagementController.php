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

class UserManagementController extends Controller
{
    public function view(Request $request): View
    {    
        $users = User::all()->sortBy('role_id');
        return view('app.user-management', [
            'users' => $users]);
    }

    public function update(Request $request): RedirectResponse
    {        
        $user = User::find($request->id);
        
        $user->name = $request->name;
        $user->username = $request->username;
    
        if ($user->role != "admin")
        {
            $user->gender = $request->gender;
            if ($user->role == "customer")
            {
                $user->address = $request->address;
                $user->phone_number = $request->phone_number;
            }
        }

        $user->save();

        return redirect()->back();
    }

    public function destroy($user_id): RedirectResponse
    {
        $user = User::find($user_id);
        $customer = Customer::where('user_id', $user_id);
        $user->delete();
        $customer->delete();
        return Redirect::route('dashboard.user-management');
    }
}
