<?php

namespace App\Http\Middleware;

use App\Models\AuditTrail;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Symfony\Component\HttpFoundation\Response;

class AuditTrailLogger
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $userID = auth()->user() ? auth()->user()->id : null;
        $response = $next($request);
        AuditTrail::create([
            "user_id" => $userID ?? (auth()->user() ? auth()->user()->id : null),
            "email" => $request->email ?? null,
            "client_ip" => $request->ip(),
            "type" => Route::currentRouteName() ?? last(preg_split('~[\\\\/]+~', Route::currentRouteAction())),
            "status" => $response->getStatusCode() == 200 ? "Success" : "Failed",
            "route" => $request->path(),
        ]);
        return $response;
    }
}
