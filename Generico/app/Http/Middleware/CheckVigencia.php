<?php
namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class CheckVigencia
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (Auth::check()) {
            $user = Auth::user();

            if ($user->empresa && $user->empresa->vigencia) {
                $vigencia = $user->empresa->vigencia;

                if ($vigencia->estatus != 1 || ($vigencia->fin_vigencia && now()->gt($vigencia->fin_vigencia))) {
                    Auth::logout();
                    return redirect()->route('login')->with('error', 'La vigencia de tu empresa ha expirado.');
                }
            } else {
                Auth::logout();
                return redirect()->route('login')->with('error', 'No hay información de vigencia para tu empresa.');
            }
        }

        return $next($request);
    }
}
