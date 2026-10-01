<?php

/*
|--------------------------------------------------------------------------
| Showcase / demo login
|--------------------------------------------------------------------------
|
| The public showcase deployment (Vercel) is meant to be browsed, so typing a
| username and password just to look around is annoying. When "enabled" is
| true the Login button of the public navbar gets a small dropdown with the
| available roles (admin / guru / siswa). Choosing one signs the visitor in
| through App\Http\Controllers\DemoLoginController and drops him on the
| dashboard that belongs to that role.
|
| Every role can be pinned to a specific (demo) account by filling
| DEMO_<ROLE>_USERNAME + DEMO_<ROLE>_PASSWORD in the environment; when those
| are empty - or no longer match an account - the first account that has the
| requested role is used instead, so the dropdown keeps working after a
| database refresh.
|
| Set DEMO_LOGIN=false in the environment (Vercel -> Settings -> Environment
| Variables) to switch the whole feature off: the dropdown disappears and the
| POST route refuses to log anybody in.
|
*/

$demoLogin = env('DEMO_LOGIN');

return [

    // On by default so the showcase deployment works out of the box; only an
    // explicit false/0/off/no switches it off.
    'enabled' => blank($demoLogin) ? true : filter_var($demoLogin, FILTER_VALIDATE_BOOLEAN),

    // Keys are the values stored in users.role, so they are the values the
    // dropdown posts back to the demo login route.
    'roles' => [
        'admin' => [
            'label' => 'Admin',
            'username' => env('DEMO_ADMIN_USERNAME'),
            'password' => env('DEMO_ADMIN_PASSWORD'),
            'redirect' => '/guru/beranda',
        ],
        'guru' => [
            'label' => 'Guru',
            'username' => env('DEMO_GURU_USERNAME'),
            'password' => env('DEMO_GURU_PASSWORD'),
            'redirect' => '/beranda',
        ],
        'siswa' => [
            'label' => 'Siswa',
            'username' => env('DEMO_SISWA_USERNAME'),
            'password' => env('DEMO_SISWA_PASSWORD'),
            'redirect' => '/beranda',
        ],
    ],

];
