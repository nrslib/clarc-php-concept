<?php

$startup = new \App\Startup\Startup();
$serviceCollection = new \Clarc\Basis\Service\ServiceCollection();
$startup->configureService($serviceCollection);
$serviceProvider = $serviceCollection->buildServiceProvider();

$app = new \Clarc\Basis\Application();

return [$app, $serviceProvider];