<?php

if(!function_exists('view')) {
    function view($view = null, $data = [])
    {
        $blade = new \duncan3dc\Laravel\BladeInstance(__DIR__ .  '/../../resources/views/', '/../../resources/cache/views/');
        return $blade->render($view, $data);
    }
}