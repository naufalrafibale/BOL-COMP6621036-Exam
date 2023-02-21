<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        if ($request->role) {
            if ($request->role == "admin") {
                $request->validate([
                    'name' => ['required', 'string', 'max:255'],
                    'username' => ['required', 'string', 'max:255', 'unique:'.User::class],
                    'password' => ['required', 'confirmed'],
                    'role' => ['required', 'string'],
                ]);        
            } elseif ($request->role == "staff") {
                $request->validate([
                    'name' => ['required', 'string', 'max:255'],
                    'username' => ['required', 'string', 'max:255', 'unique:'.User::class],
                    'password' => ['required', 'confirmed'],
                    'role' => ['required', 'string', 'exists:roles,name'],
                    'gender' => ['required', 'string'],
                ]);
            } elseif ($request->role == "customer") {
                $request->validate([
                    'name' => ['required', 'string', 'max:255'],
                    'username' => ['required', 'string', 'max:255', 'unique:'.User::class],
                    'password' => ['required', 'confirmed'],
                    'role' => ['required', 'string', 'exists:roles,name'],
                    'gender' => ['required', 'string'],
                    'address' => ['required', 'string'],
                    'phone_number' => ['required', 'string'],
                ]);
            }
        }

        $role = Role::where('name', $request->role)->first();

        if ($request->role != "customer") {
            $user = User::create([
                'name' => $request->name,
                'username' => $request->username,
                'password' => Hash::make($request->password),
                'gender' => $request->gender,
                'role_id' => $role->id
            ]);
        } else {
            $user = User::create([
                'name' => $request->name,
                'username' => $request->username,
                'password' => Hash::make($request->password),
                'gender' => $request->gender,
                'role_id' => $role->id,
            ]);
            
            $customer_data = Customer::create([
                'address' => $request->address,
                'phone_number' => $request->phone_number,
                'user_id' => $user->id,
            ]);

            if (Auth::check())
            {
                return Redirect::route('dashboard.user-management');
            }
        }
        
        event(new Registered($user));

        Auth::login($user);

        return redirect(RouteServiceProvider::HOME);
    }
}
