<?php

declare(strict_types=1);

namespace Framework;

class App
{

    private Router $router;

    private Container $container;
    public function __construct(string $definationPath = null)
    {
        $this->router = new Router();
        $this->container = new Container();
        if ($definationPath) {
            $containerDefination = include $definationPath;
            $this->container->addDefinations($containerDefination);
        }
    }
    public function run()
    {
        $path = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
        $method = $_SERVER['REQUEST_METHOD'];

        $this->router->dispatch($path, $method, $this->container);
    }

    public function get(string $path, array $controller)
    {
        $this->router->add('get', $path, $controller);
    }
    public function post(string $path, $controller)
    {
        $this->router->add('post', $path, $controller);
    }
    public function put(string $path, $controller)
    {
        $this->router->add('put', $path, $controller);
    }
    public function delete(string $path, $controller)
    {
        $this->router->add('delete', $path, $controller);
    }

    public function addMiddleware(string $middleware)
    {
        $this->router->addMiddleware($middleware);
    }
}
