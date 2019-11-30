<?php


namespace Clarc\Basis\View;


class ViewFactory
{
    private $engine;

    public function __construct($engine)
    {
        $this->engine = $engine;
    }

    public function make($view, $data) {
        return new View($this->engine, $view, $data);
    }
}