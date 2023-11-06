<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Models\SessionUser;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Session;
use Illuminate\View\View;

class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     */
    public function create()
    {
        function get_operating_system()
        {
            $u_agent = isset($_SERVER['HTTP_USER_AGENT']) ? $_SERVER['HTTP_USER_AGENT'] : '';
            $operating_system = 'Unknown Operating System';

            if ($u_agent) {
                if (preg_match('/linux/i', $u_agent)) {
                    $operating_system = 'Linux';
                } elseif (preg_match('/macintosh|mac os x|mac_powerpc/i', $u_agent)) {
                    $operating_system = 'Mac';
                } elseif (preg_match('/windows|win32|win98|win95|win16/i', $u_agent)) {
                    $operating_system = 'Windows';
                } elseif (preg_match('/ubuntu/i', $u_agent)) {
                    $operating_system = 'Ubuntu';
                } elseif (preg_match('/iPhone/i', $u_agent)) {
                    $operating_system = 'IPhone';
                } elseif (preg_match('/ipod/i', $u_agent)) {
                    $operating_system = 'IPod';
                } elseif (preg_match('/ipad/i', $u_agent)) {
                    $operating_system = 'IPad';
                } elseif (preg_match('/android/i', $u_agent)) {
                    $operating_system = 'Android';
                } elseif (preg_match('/blackberry/i', $u_agent)) {
                    $operating_system = 'Blackberry';
                } elseif (preg_match('/webos/i', $u_agent)) {
                    $operating_system = 'Mobile';
                }
            } else {
                $operating_system = php_uname('s');
            }
            return $operating_system;
        }
        $os = get_operating_system();

        if ($os == 'Mac' || $os == 'Windows' || $os == 'Linux' || $os == 'IPad' || $os == 'IPhone' || $os == 'Android') {
            # code...
            return view('auth.login', ['os' => $os]);
        } else {
            return redirect('/download');
        }
    }

    /**
     * Handle an incoming authentication request.
     */
    public function store(LoginRequest $request): RedirectResponse
    {
        $android_id = $request->exdataid;
        $os = $request->gtos;
        $nip = $request->nip;
        $roles = User::Where('nip', $nip)->where('deleted_at', NULL)->get();

        if (($roles[0]->role ?? null)  == 'admin' || ($roles[0]->role ?? null)  == 'operator') {

            $request->authenticate();
            $request->session()->regenerate();
            return redirect()->intended(RouteServiceProvider::HOME);
        } else {
            if (($os == 'Linux') || ($os == 'Android')) {

                $getdatases = SessionUser::where('nip', $nip)->where('deleted_at', NULL)->get();
                // dd($getdatases, ' ', $android_id);
                $admin = User::where('nip', $nip)->where('deleted_at', NULL)->get();

                // if (($getdatases[0]->session ?? null) == $android_id) {
                if (($getdatases[0]->session ?? null) == null) {

                    // $ses = SessionUser::where('nip', $nip)->orWhere('session', $android_id)->count();
                    $ses = SessionUser::where('nip', $nip)->where('deleted_at', NULL)->count();
                    //dd($ses);
                    if ($ses == 0) {
                        $data = new SessionUser();
                        $data->nip = $nip;
                        $data->session = $android_id;
                        $data->save();
                    }

                    $request->authenticate();
                    $request->session()->regenerate();

                    return redirect()->intended(RouteServiceProvider::HOME);
                } elseif ($getdatases[0]->session == $android_id) {
                    # code...

                    $request->authenticate();
                    $request->session()->regenerate();

                    return redirect()->intended(RouteServiceProvider::HOME);
                } else {
                    return redirect('/error');
                }
            } elseif (($os == 'Mac') || ($os == 'IPad') || ($os == 'IPhone')) {
                $session_id = Session::getId();
                $ses = SessionUser::where('nip', $nip)->orWhere('session', $session_id)->count();
                if ($ses == 0) {
                    $data = new SessionUser();
                    $data->nip = $nip;
                    $data->session = $session_id;
                    $data->save();
                }

                $getdatases = SessionUser::where('nip', $nip)->get();

                if (($getdatases[0]->session ?? 'null') == $session_id) {

                    $request->authenticate();
                    $request->session()->regenerate();

                    return redirect()->intended(RouteServiceProvider::HOME);
                } else {
                    return redirect('/error');
                }
            } elseif ($os == 'Windows') {
                $session_id = Session::getId();
                $ses = SessionUser::where('nip', $nip)->orWhere('session', $session_id)->count();
                if ($ses == 0) {
                    $data = new SessionUser();
                    $data->nip = $nip;
                    $data->session = $session_id;
                    $data->save();
                }

                $getdatases = SessionUser::where('nip', $nip)->get();
                $admin = User::where('nip', $nip)->get();
                if ((($getdatases[0]->session ?? 'null') == $session_id) && ((($admin[0]->role ?? null) == 'admin') || (($admin[0]->role ?? null) == 'operator'))) {

                    $request->authenticate();
                    $request->session()->regenerate();

                    return redirect()->intended(RouteServiceProvider::HOME);
                } else {
                    return redirect('/download');
                }
            } else {
                return redirect('/download');
            }
        }
    }

    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): RedirectResponse
    {
        $admin = Auth::user()->role;
        $nip = Auth::user()->nip;
        if ($admin == 'admin' || $admin == 'operator') {
            SessionUser::where('nip', $nip)->delete();

            Auth::guard('web')->logout();
            $request->session()->invalidate();
            $request->session()->regenerateToken();
            return redirect('/');
        }
        return redirect('/');
    }
}
