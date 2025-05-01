<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SetRequestLanguage
{
    public function handle(Request $request, Closure $next)
    {
        $lang = $request->query('lang', 'de');
        $lang = in_array($lang, ['ar', 'de']) ? $lang : 'de';
        
        // Check if user is admin
        $showAllLanguages =  auth('sanctum')->user() &&  auth('sanctum')->user()->role == 'admin';
        
        $request->attributes->add([
            'validated_lang' => $lang,
            'show_all_languages' => $showAllLanguages
        ]);
        
        return $next($request);
    }
}