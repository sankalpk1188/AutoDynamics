<?php

namespace App\Support;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class SiteLaunch
{
    public static function isEnabled(): bool
    {
        return (bool) config('site_launch.enabled', false);
    }

    public static function launchAt(): ?Carbon
    {
        $raw = config('site_launch.launch_at');
        if (empty($raw)) {
            return null;
        }

        return Carbon::parse($raw, config('site_launch.timezone', 'Asia/Kolkata'));
    }

    public static function hasLaunched(): bool
    {
        $launchAt = self::launchAt();
        if (!$launchAt) {
            return true;
        }

        return now(config('site_launch.timezone', 'Asia/Kolkata'))->gte($launchAt);
    }

    public static function isLocked(): bool
    {
        return self::isEnabled() && !self::hasLaunched();
    }

    public static function shouldBypass(Request $request): bool
    {
        if ($request->routeIs('site.launch')) {
            return true;
        }

        $path = trim($request->path(), '/');
        $prefixes = config('site_launch.bypass_prefixes', []);

        foreach ($prefixes as $prefix) {
            $prefix = trim($prefix, '/');
            if ($prefix === '') {
                continue;
            }
            if ($path === $prefix || Str::startsWith($path, $prefix . '/')) {
                return true;
            }
        }

        return false;
    }

    public static function launchTimestampMs(): int
    {
        $launchAt = self::launchAt();

        return $launchAt ? ($launchAt->getTimestamp() * 1000) : 0;
    }

    public static function launchAtFormatted(): ?string
    {
        $launchAt = self::launchAt();

        return $launchAt ? $launchAt->format('g:i A') : null;
    }

    public static function launchAtIso(): ?string
    {
        $launchAt = self::launchAt();

        return $launchAt ? $launchAt->toIso8601String() : null;
    }

    public static function imageUrl(): string
    {
        $path = config('site_launch.image', 'assets/images/site-launch/maintenance.png');

        return asset($path);
    }
}
