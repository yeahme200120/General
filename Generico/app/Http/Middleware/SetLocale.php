<?php
namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class SetLocale
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Configuración regional
        app()->setLocale(config('app.locale'));
        
        // Obtención de la respuesta
        $response = $next($request);
        
        // Configuración de headers con verificación de tipos
        if ($response instanceof \Illuminate\Http\Response) {
            return $response->withHeaders([
                'Content-Type' => 'text/html; charset=UTF-8',
                'X-Locale' => config('app.locale'),
                'X-Application' => config('app.name')
            ]);
        }
        
        // Fallback para otros tipos de respuesta
        $response->headers->set('Content-Type', 'text/html; charset=UTF-8');
        $response->headers->set('X-Locale', config('app.locale'));
        
        return $response;
    }
}
