<?php


namespace Clarc\Basis\Routing;


class Route
{
    /**
     * @var string
     */
    private $url;

    /**
     * @var string
     */
    private $methods;

    /**
     * @var string
     */
    private $controller;

    /**
     * Route constructor.
     * @param string $url
     * @param string $methods
     * @param string $controller
     */
    public function __construct(string $url, string $methods, string $controller)
    {
        $this->url = $url;
        $this->methods = $methods;
        $this->controller = $controller;
    }

    public function getController() {

    }
}