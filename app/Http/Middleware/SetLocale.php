<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use App\Models\Impostazione;

class SetLocale
{
    public function handle(Request $request, Closure $next): mixed
    {
        $segment = $request->segment(1); // first URL segment

        if (in_array($segment, ['en', 'es'], true)) {
            // Only activate if the language is enabled in settings
            if (Impostazione::get("lingua_{$segment}_attiva") === '1') {
                App::setLocale($segment);
            }
        }

        return $next($request);
    }
}
