<?php

namespace BlazonCms\Core\Cache;

use Interop\Container\ContainerInterface;

class DoctrineCache
{
    public function __invoke(ContainerInterface $serviceLocator)
    {
        /** @var \Zend\Cache\Storage\StorageInterface $zendCache */
        $zendCache = $serviceLocator->get('BlazonCms\Core\Service\Cache');

        $cache = new ZendStorageCache();
        $cache->setZendStorage($zendCache);

        return $cache;
    }
}

