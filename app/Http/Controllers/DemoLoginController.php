<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DemoLoginController extends Controller
{
    /**
     * Sign a showcase visitor in as one of the roles listed in config/demo.php
     * (admin, guru or siswa) without asking for credentials.
     */
    public function store(Request $request): RedirectResponse
    {
        $role = strtolower(trim((string) $request->input('role')));
        $accounts = config('demo.roles', []);

        // The dropdown is only rendered when the demo login is enabled, so a hand
        // made request is refused as well as soon as the feature is switched off.
        if (! config('demo.enabled') || ! array_key_exists($role, $accounts)) {
            return redirect()->route('login');
        }

        $account = $accounts[$role];
        $user = $this->resolveUser($role, $account['username'] ?? null, $account['password'] ?? null);

        if (! $user) {
            return redirect()->route('login')->withErrors([
                'username' => __('Demo login untuk role :role tidak tersedia (periksa akun demo atau DEMO_*_USERNAME / DEMO_*_PASSWORD).', ['role' => $role]),
            ]);
        }

        Auth::guard('web')->login($user);
        $request->session()->regenerate();

        return redirect()->intended($account['redirect'] ?? route('dashboard'));
    }

    /**
     * An account pinned in the environment (DEMO_<ROLE>_USERNAME /
     * DEMO_<ROLE>_PASSWORD) is tried first. When the pin is empty - or no
     * longer matches an account, which would otherwise break the dropdown
     * after a database refresh - the first account that has the requested
     * role is used instead.
     */
    private function resolveUser(string $role, ?string $username, ?string $password): ?User
    {
        if ($username && $password && Auth::guard('web')->attempt(['username' => $username, 'password' => $password])) {
            return Auth::guard('web')->user();
        }

        return User::where('role', $role)->orderBy('id')->first();
    }
}
