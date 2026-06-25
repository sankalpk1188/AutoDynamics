<?php

namespace App\Http\Middleware;

use App\Support\SiteLaunch;
use Closure;
use Illuminate\Http\Request;

class SiteLaunchGate
{
    public function handle(Request $request, Closure $next)
    {
        if (!SiteLaunch::isLocked() || SiteLaunch::shouldBypass($request)) {
            return $next($request);
        }

        if ($request->expectsJson()) {
            return response()->json([
                'message' => 'Website is under maintenance. Please check back soon.',
                'launch_at' => SiteLaunch::launchAtIso(),
            ], 503);
        }

        return response()->view('site_launch', [
            'launchTimestampMs' => SiteLaunch::launchTimestampMs(),
            'launchAtFormatted' => SiteLaunch::launchAtFormatted(),
            'imageUrl' => SiteLaunch::imageUrl(),
            'title' => config('site_launch.title'),
            'message' => config('site_launch.message'),
        ]);
    }
}
