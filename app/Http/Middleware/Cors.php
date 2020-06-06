<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Events\Dispatcher;
use Illuminate\Foundation\Http\Events\RequestHandled;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class Cors
{
    private $events;

    public function __construct(Dispatcher $events)
    {
        $this->events = $events;
    }

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if (!$this->isCorsRequest($request)) {
            return $next($request);
        }
        if ($request->getMethod() == "OPTIONS") {
            return $this->preflightResponse();
        }

        if (class_exists(RequestHandled::class)) {
            $this->events->listen(RequestHandled::class, function (RequestHandled $event) {
                $this->addHeaders($event->response);
            });
        } else {
            $this->events->listen('kernel.handled', function (Request $request, Response $response) {
                $this->addHeaders($response);
            });
        }
        $response = $next($request);
        return $this->addHeaders($response);
    }

    private function isSameHost(Request $request)
    {
        return $request->headers->get('Origin') === $request->getSchemeAndHttpHost();
    }

    private function isCorsRequest(Request $request)
    {
        return $request->headers->has('Origin') && !$this->isSameHost($request);
    }

    private function headers()
    {
        return config('cors')['headers'];
    }

    private function preflightResponse()
    {
        return response('OK', 200, $this->headers());
    }

    private function addHeaders(Response $response)
    {
        if (!$response->headers->has('Access-Control-Allow-Origin')) {
            $headers = $this->headers();
            foreach ($headers as $key => $value)
                $response->headers->set($key, $value);
        }
        return $response;
    }
}
