<?php

namespace App\Filters\Properties;

use Closure;
use App\Filters\Pipe;

class PropertiesStoreysFilter implements Pipe
{
    public function apply($properties, Closure $next)
    {
        if (request()->has('storeys')) {
            $storeys = request()->get('storeys');
            if ((int) $storeys > 0) {
                $properties->where('storeys', (int) $storeys);
            }
        }

        return $next($properties);
    }
}
