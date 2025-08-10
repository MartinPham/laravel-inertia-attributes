<?php

namespace MartinPham\InertiaAttributes\Http\Middleware;

use MartinPham\InertiaAttributes\Attributes\InertiaPage;
use Closure;
use Illuminate\Http\Request;
use ReflectionMethod;

class InertiaAttributesMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next): mixed
    {
        $response = $next($request);

        // Only process if we have a route and controller action
        if (!$request->route() || !($controllerAction = $request->route()->getAction('controller'))) {
            return $response;
        }

        // Parse the controller and method
        $parts = explode('@', $controllerAction);
        if (count($parts) !== 2) {
            return $response;
        }

        [$controller, $method] = $parts;

        // Check if the controller and method exist
        if (!class_exists($controller) || !method_exists($controller, $method)) {
            return $response;
        }

        // Use reflection to get the method attributes
        $reflectionMethod = new ReflectionMethod($controller, $method);
        $attributes = $reflectionMethod->getAttributes(InertiaPage::class);

        // If no Inertia attribute is found, return the original response
        if (empty($attributes)) {
            return $response;
        }

        // Get the Inertia attribute instance
        $inertiaAttribute = $attributes[0]->newInstance();

        // If the response is not already an Inertia response, process it
        if (!$response instanceof \Inertia\Response) {
            // Get the original data from the response
            $data = $response->original ?? $response;

            // Process the data with the Inertia attribute
            if (!is_string($data)) {
                return $inertiaAttribute->process($data);
            }
        }

        return $response;
    }
}
