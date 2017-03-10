<?php

return [
    'dependencies' => [
        'factories' => [
            'doctrine.entity_manager.orm_vcms' => [\ContainerInteropDoctrine\EntityManagerFactory::class, 'orm_vcms'],
            \BlazonCms\Core\Action\Index::class => \BlazonCms\Core\Action\Index::class,
            \BlazonCms\Core\EventListener\DoctrineEventSubscriber::class => \BlazonCms\Core\EventListener\DoctrineEventSubscriber::class,
            'BlazonCms\Core\Service\Cache' => \BlazonCms\Core\Cache\CacheFactory::class,
            'doctrine.cache.orm_vcms' => \BlazonCms\Core\Cache\DoctrineCache::class
        ],
    ],

    'routes' => array(
        'vcms' => array(
            'path' => '/vcms',
            'middleware' => \BlazonCms\Core\Action\Index::class,
            'allowed_methods' => [ 'GET' ],
        ),
    ),

    'doctrine' => [
        'connection' => [
            'orm_vcms' => [
                'params' => [
                    'url' => 'mysql://root:root@localhost/VCMS',
                ],
            ],
        ],
        'event_manager' => [
            'orm_vcms' => [
                'subscribers' => [
                    \BlazonCms\Core\EventListener\DoctrineEventSubscriber::class => \BlazonCms\Core\EventListener\DoctrineEventSubscriber::class,
                    Gedmo\Sluggable\SluggableListener::class => Gedmo\Sluggable\SluggableListener::class
                ],
            ],
        ],
        'driver' => [
            'orm_vcms' => [
                'class' => \Doctrine\Common\Persistence\Mapping\Driver\MappingDriverChain::class,
                'drivers' => [
                    'BlazonCms\Core\Entity' => 'vcms',
                ],
            ],
            'vcms' => [
                'class' => \Doctrine\ORM\Mapping\Driver\AnnotationDriver::class,
                'cache' => 'orm_vcms',
                'paths' => [__DIR__ . '/../src/Entity'],
            ],
        ],
    ],
    
    'BlazonCms\Core\Config' => [
        'db_prefix' => 'bcms_',
        
        'cache' => [
            'adapter' => 'Memory',
            'plugins' => [],
            'options' => [ //'namespace' => 'RcmCache'
            ]
        ]
    ]
];
