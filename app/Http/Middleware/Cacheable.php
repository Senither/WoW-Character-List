<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Response;
use Illuminate\Cache\Repository as Cache;

class Cacheable
{
    /**
     * @var \Illuminate\Cache\Repository
     */
    protected $cache;

    /**
     * @var array
     */
    protected $except_routes = [];

    /**
     * @param Illuminate\Cache\Repository $cache
     */
    public function __construct(Cache $cache)
    {
        $this->cache = $cache;
    }

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next, $cacheTime = 10)
    {
        if (env('APP_ENV') === 'local' || $this->isExceptPath($request)) {
            return $next($request);
        }

        $key = $this->createCacheSignature($request);

        if ($this->cache->has($key)) {
            return $this->unserialize($this->cache->get($key));
        }

        $response = $next($request);

        $this->cache->put($key, $this->serialize($response), $cacheTime);

        return $response;
    }

    /**
     * Creates a unique signature for the URI so we can cache the reponse.
     *
     * @param  \Illuminate\Http\Request $request
     *
     * @return string
     */
    protected function createCacheSignature($request)
    {
        $key = trim(str_replace('/', '.', $request->getRequestUri()), '.');

        return "cacheable.{$key}.{$request->getMethod()}";
    }

    /**
     * Serialize a response.
     *
     * @param \Illuminate\Http\Response $response
     *
     * @return string
     */
    public function serialize($response)
    {
        $content    = $response->getContent();
        $statusCode = $response->getStatusCode();
        $headers    = $response->headers;

        return serialize(compact('content', 'statusCode', 'headers'));
    }

    /**
     * Unserialize a response.
     *
     * @param $serializedResponse
     *
     * @return \Illuminate\Http\Response
     */
    public function unserialize($serializedResponse)
    {
        $responseProperties = unserialize($serializedResponse);
        $response           = new Response($responseProperties['content'], $responseProperties['statusCode']);
        $response->headers  = $responseProperties['headers'];

        return $response;
    }

    /**
     * Checks if the requested route is in the except array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return boolean
     */
    protected function isExceptPath($request)
    {
        $route = $this->getRoute($request);

        if ($route == null) {
            return false;
        }

        return in_array($route, $this->except_routes);
    }

    /**
     * Gets the route from the request, if the route is a closure null will be returned.
     *
     * @param  \Illuminate\Http\Request $request
     * @return boolean|null
     */
    protected function getRoute($request)
    {
        $uses = $request->route()->getAction()['uses'];

        if ($uses instanceof \Closure) {
            return null;
        }

        $parts = explode('\\', $uses);
    
        return $parts[count($parts) - 1];
    }
}
