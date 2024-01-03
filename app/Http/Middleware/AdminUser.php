<?php

namespace App\Http\Middleware;

use App\Config\RolesEnum;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AdminUser
{
    /**
     * Handle an incoming request.
     *
     * @param Closure(Request): (Response) $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if ($request->user()->hasRole(RolesEnum::ADMIN->value)) {
            return $next($request);
        }
        return abort(\Illuminate\Http\Response::HTTP_FORBIDDEN);
    }
}
