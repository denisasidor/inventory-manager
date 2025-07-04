<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CompanyInvitation;
use App\Models\User;

use Illuminate\Support\Facades\Hash;

class InvitedRegistrationController extends Controller
{
    public function showForm($token)
    {
        $invitation = CompanyInvitation::where('token', $token)
            ->where('expires_at', '>', now())
            ->firstOrFail();

        return view('auth.invited-register', ['invitation' => $invitation]);
    }

    public function submitForm(Request $request, $token)
    {
        $invitation = CompanyInvitation::where('token', $token)
            ->where('expires_at', '>', now())
            ->firstOrFail();

        $request->validate([
            'password' => 'required|confirmed|min:6',
        ]);

        $user = User::create([
            'name' => $invitation->email,
            'email' => $invitation->email,
            'password' => Hash::make($request->password),
            'company_id' => $invitation->company_id,
        ]);

        $user->assignRole($invitation->role);


        $invitation->delete();

        auth()->login($user);

        return redirect()->route('filament.admin.pages.dashboard');
    }
}
