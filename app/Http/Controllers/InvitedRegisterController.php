<?php

namespace App\Http\Controllers;

use App\Models\CompanyInvitation;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class InvitedRegisterController extends Controller
{
    public function showForm($token)
    {
        $invitation = CompanyInvitation::where('token', $token)->firstOrFail();

        return view('auth.invited-register', [
            'token' => $token,
            'email' => $invitation->email,
        ]);
    }

    public function register(Request $request)
    {
        $request->validate([
            'token' => 'required|exists:company_invitations,token',
            'name' => 'required|string|max:255',
            'password' => 'required|confirmed|min:6',
        ]);

        $invitation = CompanyInvitation::where('token', $request->token)->firstOrFail();
        $existingUser = User::where('email', $invitation->email)->first();
        if ($existingUser) {

            auth()->login($existingUser);
            return redirect()->route('filament.admin.pages.dashboard');
        }
        $user = User::create([
            'name' => $request->name,
            'email' => $invitation->email,
            'password' => Hash::make($request->password),
            'company_id' => $invitation->company_id,
            'role' => $invitation->role,
        ]);

        $user->assignRole($invitation->role);

        $invitation->delete();


        auth()->login($user);

        return redirect()->route('filament.admin.pages.dashboard');
    }
}
