<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class BlogStatus
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {



        $blogStatus = blog()->site_status ?? \App\Enums\BlogStatus::ACTIVE->value;




        switch ($blogStatus) {
            case \App\Enums\BlogStatus::INACTIVE->value:
                abort(503);
                break;

            case \App\Enums\BlogStatus::MAINTENANCE->value:
                abort(503);
                break;

            case \App\Enums\BlogStatus::DRAFT->value:
                abort(500);

            default:
                return $next($request);
                break;
        }
    }
}
