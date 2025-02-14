<?php

namespace App\Filters\Properties;

use Closure;
use App\Filters\Pipe;

class PropertiesBathroomsFilter implements Pipe
{
    public function apply($properties, Closure $next)
    {
        if (request()->has('bathrooms')) {
            $bathrooms = request()->get('bathrooms');
            if ((int) $bathrooms > 0) {
                $properties->where('bathrooms', (int) $bathrooms);
            }
        }

        return $next($properties);
    }
}
