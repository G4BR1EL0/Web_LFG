<?php
namespace App\Http\Middleware;
use Closure;

class CheckRole
{
    public function handle($request, Closure $next)
    {
        $userRole = $request->user()->role;
        
        if ($userRole) {
            $request->request->add([
                'scope' => $userRole
            ]);            
        }
        return $next($request);
    }
}
