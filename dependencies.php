<?php

declare(strict_types=1);

use App\Services\SessionService;
use App\Services\DatabaseConnection;
use DI\Container;

$builder = new ContainerBuilder();

$builder->addDefinitions([
    DatabaseConnection::class => function (Container $container) {
        return new DatabaseConnection(/* Paramètres de connexion à la base de données */);
    },
    SessionService::class => function (Container $container) {
        return new SessionService($container);
    },
]);

$container = $builder->buildDevMode()->make();

return $container;