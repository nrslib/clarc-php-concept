<?php

namespace Clarc\Basis\Http;

use Clarc\Basis\Application;
use Clarc\Basis\Service\ServiceProvider;

class Kernel
{
    /**
     * @var Application
     */
    private $app;
    /**
     * @var ServiceProvider
     */
    private $serviceProvider;

    public function __construct(Application $app, ServiceProvider $serviceProvider)
    {
        $this->app = $app;
        $this->serviceProvider = $serviceProvider;
    }

    public function handle()
    {
        $controllerName = $this->getControllerName($_SERVER);

        $controller = $this->serviceProvider->resolve($controllerName);
        $controller->interact();
    }

    private function getControllerName($server) {
        $root = $server['DOCUMENT_ROOT'];
        $url = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
        $tokens = explode('/', $url);
        $count = count($tokens);
        $top = ucfirst($tokens[1]);
        $second = ucfirst($tokens[2]);
        $path = $root . '/app/InterfaceAdapters/Controllers/' .  $top . '/' . $second . '/' . $top . $second . 'Controller.php';
        if ($count === 3 && file_exists($path)) {
            return 'App\\InterfaceAdapters\\Controllers\\' . $top . '\\' . $second . '\\' . $top . $second . 'Controller';
        }

        return null;
    }
}