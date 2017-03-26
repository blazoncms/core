<?php

$container= array();

if (file_exists(__DIR__.'/../../config/container.php')) {
    $container = require __DIR__.'/../../config/container.php';
} else {
    $container = require __DIR__.'/../../../../config/container.php';
}

return new \Symfony\Component\Console\Helper\HelperSet([
    'em' => new \Doctrine\ORM\Tools\Console\Helper\EntityManagerHelper(
        $container->get('doctrine.entity_manager.orm_blazon_cms')
    ),
]);
