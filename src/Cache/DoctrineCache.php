<?php

namespace Ctt\BlazonCms\Cache;

use Interop\Container\ContainerInterface;

class DoctrineCache
{
    public function __invoke(ContainerInterface $serviceLocator)
    {
        /** @var \Zend\Cache\Storage\StorageInterface $zendCache */
        $zendCache = $serviceLocator->get('Ctt\BlazonCms\Service\Cache');

        return new ZendStorageCache($zendCache);
    }
}

