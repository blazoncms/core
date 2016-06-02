<?php

namespace Ctt\BlazonCms\Cache;

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
                    'name' => $config['Ctt\BlazonCms\Config']['cache']['adapter'],
                    'options' => $config['Ctt\BlazonCms\Config']['cache']['options'],
                ],
                'plugins' => $config['Ctt\BlazonCms\Config']['cache']['plugins'],
            ]
        );
    }
}
