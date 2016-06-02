<?php

namespace BlazonCms\Core\Cache;

use Interop\Container\ContainerInterface;
use Zend\Cache\StorageFactory;

class CacheFactory
{
    public function __invoke(ContainerInterface $serviceLocator)
    {
        $config = $serviceLocator->get('config');

        return StorageFactory::factory(
            [
                'adapter' => [
                    'name' => $config['BlazonCms\Core\Config']['cache']['adapter'],
                    'options' => $config['BlazonCms\Core\Config']['cache']['options'],
                ],
                'plugins' => $config['BlazonCms\Core\Config']['cache']['plugins'],
            ]
        );
    }
}
