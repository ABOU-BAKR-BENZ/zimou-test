<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Store;
use App\Models\User;
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
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:' . User::class],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            'storeName' => ['required', 'string', 'unique:stores,name'],
            'code' => ['nullable', 'string', 'max:10'],
            'phones' => ['nullable', 'string'],
            'company_name' => ['nullable', 'string', 'max:255'],
            'capital' => ['nullable', 'numeric'],
            'address' => ['nullable', 'string', 'max:255'],
            'register_commerce_number' => ['nullable', 'string', 'max:255'],
            'nif' => ['nullable', 'string', 'max:255'],
            'legal_form' => ['nullable', 'integer', 'min:1'],
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        $store = Store::create(
            [
                'code' => $request->code,
                'name' => $request->name,
                'email' => $request->email,
                'phones' => $request->phones,
                'company_name' => $request->company_name,
                'capital' => $request->capital,
                'address' => $request->address,
                'register_commerce_number' => $request->register_commerce_number,
                'nif' => $request->nif,
                'legal_form' => $request->legal_form,
                'status' => 0,
                'can_update_preparing_packages' => 0
            ]
        );

        event(new Registered($user));

        Auth::login($user);

        return redirect(route('dashboard', absolute: false));
    }
}
