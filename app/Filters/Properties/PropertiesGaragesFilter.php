<?php

namespace App\Filters\Properties;

use Closure;
use App\Filters\Pipe;

class PropertiesGaragesFilter implements Pipe
{
    public function apply($properties, Closure $next)
    {
        if (request()->has('garages')) {
            $garages = request()->get('garages');
            if ((int) $garages > 0) {
                $properties->where('garages', (int) $garages);
            }
        }

        return $next($properties);
    }
}
