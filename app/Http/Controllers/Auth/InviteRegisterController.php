<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\CompanyInvitation;
use App\Models\User;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Hash;
class InviteRegisterController extends Controller
{
    public function show($token)
    {
        $invitation = CompanyInvitation::where('token', $token)
            ->where('expires_at', '>', now())
            ->firstOrFail();

        return view('auth.invite-register', ['invitation' => $invitation]);
    }

    public function store(Request $request, $token)
    {
        $request->validate(['password' => 'required|confirmed|min:6']);

        $invitation = CompanyInvitation::where('token', $token)
            ->where('expires_at', '>', now())
            ->firstOrFail();

        $user = User::create([
            'name' => $invitation->email,
            'email' => $invitation->email,
            'password' => Hash::make($request->password),
            'company_id' => $invitation->company_id,
        ]);

        $user->assignRole($invitation->role);
        $invitation->delete();

        auth()->login($user);

        return redirect()->route('dashboard');
    }
}
