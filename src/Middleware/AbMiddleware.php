<?php

namespace Bart\Ab\Middleware;

use Closure;
use Bart\Ab\Ab;

class AbMiddleware
{

    protected $ab;

    public function __construct(Ab $ab)
    {
        $this->ab = $ab;
    }

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $forcedVersion = $request->query('forcedVersion', null);

        if ($forcedVersion !== null) {
            $this->ab->setForcedVersion($forcedVersion);
        }

        return $next($request);
    }
}
