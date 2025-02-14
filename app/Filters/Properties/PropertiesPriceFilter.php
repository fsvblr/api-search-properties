<?php

namespace App\Filters\Properties;

use Closure;
use App\Filters\Pipe;

class PropertiesPriceFilter implements Pipe
{
    public function apply($properties, Closure $next)
    {
        if (request()->has('priceRange')) {
            $priceRange = request()->get('priceRange');
            if (is_array($priceRange) && count($priceRange) === 2) {
                $properties->whereBetween('price', $priceRange);
            }
        }

        return $next($properties);
    }
}
