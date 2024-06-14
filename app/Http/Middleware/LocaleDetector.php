<?php

declare(strict_types=1);

namespace App\Http\Middleware;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Symfony\Component\HttpFoundation\Response;

class LocaleDetector
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, \Closure $next): Response
    {
        $path = $request->decodedPath();

        if ($this->matchesLocale($path, 'fr')) {
            App::setLocale('fr');
        } else if ($this->matchesLocale($path, 'es')) {
            App::setLocale('es');
        } else {
            App::setLocale(App::getFallbackLocale());
        }

        return $next($request);
    }

    protected function matchesLocale(string $uri, string $locale): bool
    {
        return $uri === $locale
            || str_starts_with($uri, "{$locale}/")
            || str_starts_with($uri, "/{$locale}/");
    }
}
