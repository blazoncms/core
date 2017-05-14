<?php

return [
    'dependencies' => [
        'factories' => [
            'doctrine.entity_manager.orm_blazon_cms' => [\ContainerInteropDoctrine\EntityManagerFactory::class, 'orm_blazon_cms'],
            \BlazonCms\Core\Action\Index::class => \BlazonCms\Core\Action\Index::class,
            \BlazonCms\Core\EventListener\DoctrineEventSubscriber::class => \BlazonCms\Core\EventListener\DoctrineEventSubscriber::class,
            'BlazonCms\Core\Service\Cache' => \BlazonCms\Core\Cache\CacheFactory::class,
            'doctrine.cache.orm_blazon_cms' => \BlazonCms\Core\Cache\DoctrineCache::class
        ],
    ],

    'routes' => array(
        'bcms' => array(
            'path' => '/bcms',
            'middleware' => \BlazonCms\Core\Action\Index::class,
            'allowed_methods' => [ 'GET' ],
        ),
    ),

    'doctrine' => [
        'connection' => [
            'orm_blazon_cms' => [
                'params' => [
                    'url' => 'mysql://root:root@localhost/BLAZON',
                ],
            ],
        ],
        'event_manager' => [
            'orm_blazon_cms' => [
                'subscribers' => [
                    \BlazonCms\Core\EventListener\DoctrineEventSubscriber::class => \BlazonCms\Core\EventListener\DoctrineEventSubscriber::class,
                    \Gedmo\Timestampable\TimestampableListener::class => \Gedmo\Timestampable\TimestampableListener::class,
                ],
            ],
        ],
        'driver' => [
            'orm_blazon_cms' => [
                'class' => \Doctrine\Common\Persistence\Mapping\Driver\MappingDriverChain::class,
                'drivers' => [
                    'BlazonCms\Core\Entity' => 'bcms',
                ],
            ],
            'bcms' => [
                'class' => \Doctrine\ORM\Mapping\Driver\AnnotationDriver::class,
                'cache' => 'orm_blazon_cms',
                'paths' => [__DIR__ . '/../src/Entity'],
            ],
        ],
    ],
    
    'BlazonCms\Core\Config' => [
        'db_prefix' => 'blazon_',
        
        'cache' => [
            'adapter' => 'Memory',
            'plugins' => [],
            'options' => []
        ]
    ]
];
