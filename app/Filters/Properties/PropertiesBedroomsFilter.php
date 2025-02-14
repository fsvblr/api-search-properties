<?php

namespace App\Filters\Properties;

use Closure;
use App\Filters\Pipe;

class PropertiesBedroomsFilter implements Pipe
{
    public function apply($properties, Closure $next)
    {
        if (request()->has('bedrooms')) {
            $bedrooms = request()->get('bedrooms');
            if ((int) $bedrooms > 0) {
                $properties->where('bedrooms', (int) $bedrooms);
            }
        }

        return $next($properties);
    }
}
