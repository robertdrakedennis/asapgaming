<?php

namespace App\Http\Middleware;

use App\Services\SteamService;
use Closure;

class ParseSteamIDs
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \Closure $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if (!$request->hasAny('steamid', 'steamids')) {
            return $next($request);
        }

        $steam = resolve(SteamService::class);

        if ($request->has('steamid')) {
            $id = $request->get('steamid');

            $request->replace(array_replace($request->input(), [
                'steamid' => $steam->idToAID($id)
            ]));
        }

        return $next($request);
    }
}
