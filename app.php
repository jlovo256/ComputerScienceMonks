<?php

/**
 * app short summary.
 *
 * app description.
 *
 * @version 1.0
 * @author Jamie Tudor
 */
class App
{
    protected $routes = [];
    protected $responseStatus = '200 OK';
    protected $responseContentType = 'text/html';
    protected $responseBody = 'Hello World';

    public function addRoute($routePath, $routeCallback)
    {
        $this->routes[$routePath] = $routeCallback->bindTo($this, __CLASS__);
    }

    public function dispatch($currentPath)
    {
        foreach ($this->routes as $routePath => $callback)
        {
            if ($routePath === $currentPath)
            {
                $callback();
            }
        }

        header('HTTP/1.1 ' . $this->responseBody);
        header('Content-type: ' . $this->responseContentType);
        header('Content-length: ' . mb_strlen($this->responseBody));
        echo $this->responseBody;
    }
}