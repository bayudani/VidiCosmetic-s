<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\URL;

class UpgradeToHttpsUnderNgrok
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Cek apakah alamatnya mengandung domain ngrok
        if (str_ends_with($request->getHost(), '.ngrok-free.app')) {
            // Jika iya, paksa semua URL yang digenerate jadi HTTPS
            URL::forceScheme('https');
        }

        return $next($request);
    }
}
