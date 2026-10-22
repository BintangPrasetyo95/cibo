<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class PastikanPeran
{
    /**
     * Handle an incoming request (Pertemuan 7 Slide 12).
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, string ...$peran): Response
    {
        if (! in_array($request->user()?->peran, $peran, true)) {
            abort(403, 'Akses ditolak. Anda tidak memiliki kewenangan peran untuk tindakan ini.');
        }

        return $next($request);
    }
}
