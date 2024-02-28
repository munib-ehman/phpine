<?php

declare(strict_types=1);

namespace Framework;

use PDO;

class Router
{
   private array $middlewares = [];
   private array $routes = [];

   public function add(string $method, string $path, array $controller)
   {
      $path = $this->normalizePath(($path));
      $regPath = preg_replace('#{[^/]+}#', '([^/]+)', $path);
      $this->routes[] = [
         'path' => $path,
         'method' => strtoupper($method),
         'controller' => $controller,
         'middlewares' => [],
         'regexPath' => $regPath,
      ];
   }

   private function normalizePath(string $path): string
   {
      $path = trim($path, '/');
      $path = "/{$path}/";
      $path = preg_replace('#[/]{2,}#', '/', $path);
      return $path;
   }

   public function dispatch($path, $method, Container $container = null)
   {
      $path = $this->normalizePath($path);
      $method = strtoupper($_POST['_METHOD'] ?? $method);

      foreach ($this->routes as $route) {
         if (
            !preg_match("#^{$route['regexPath']}$#", $path, $paramValues)
            || $route['method'] !== $method
         ) {
            continue;
         }

         array_shift($paramValues);

         preg_match_all('#{([^/]+)}#', $route['path'], $paramKeys);

         array_shift($paramKeys);

         $params = array_combine($paramKeys[0], $paramValues);

         [$class, $function] = $route['controller'];

         $classIntance = $container ? $container->resolve($class) :  new $class;

         if ($classIntance) {
            $action = fn () => $classIntance->{$function}($params);

            $allMiddleware = [...$route['middlewares'], ...$this->middlewares];

            foreach ($allMiddleware as $middleware) {
               $middleware = $container ? $container->resolve($middleware) : new $middleware;
               $action = fn () => $middleware->process($action);
            }
            $action();
            return;
         }
      }
   }

   public function addMiddleware(string $middleware)
   {
      $this->middlewares[] = $middleware;
   }
   public function addRouteMiddleware(string $middleware)
   {
      $lastIndex = array_key_last($this->routes);
      $this->routes[$lastIndex]['middlewares'][] = $middleware;
   }
}
