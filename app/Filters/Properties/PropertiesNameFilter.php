<?php

namespace App\Filters\Properties;

use Closure;
use App\Filters\Pipe;

class PropertiesNameFilter implements Pipe
{
    public function apply($properties, Closure $next)
    {
        if (request()->has('name')) {
            $name = request()->get('name');
            if (trim($name) !== '') {
                $properties->whereLike('name', '%' . $name . '%');
            }
        }

        return $next($properties);
    }
}
