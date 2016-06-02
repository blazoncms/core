<?php

return [
    'dependencies' => [
        'factories' => [
            'doctrine.entity_manager.orm_vcms' => [\ContainerInteropDoctrine\EntityManagerFactory::class, 'orm_vcms'],
            \Ctt\BlazonCms\Action\Index::class => \Ctt\BlazonCms\Action\Index::class,
            \Ctt\BlazonCms\EventListener\DoctrineEventSubscriber::class => \Ctt\BlazonCms\EventListener\DoctrineEventSubscriber::class,
            'Ctt\BlazonCms\Service\Cache' => \Ctt\BlazonCms\Cache\CacheFactory::class,
            'doctrine.cache.orm_vcms' => \Ctt\BlazonCms\Cache\DoctrineCache::class
        ],
    ],

    'routes' => array(
        'contentManager' => array(
            'path' => '/vcms',
            'middleware' => \Ctt\BlazonCms\Action\Index::class,
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
                    \Ctt\BlazonCms\EventListener\DoctrineEventSubscriber::class => \Ctt\BlazonCms\EventListener\DoctrineEventSubscriber::class,
                    Gedmo\Sluggable\SluggableListener::class => Gedmo\Sluggable\SluggableListener::class
                ],
            ],
        ],
        'driver' => [
            'orm_vcms' => [
                'class' => \Doctrine\Common\Persistence\Mapping\Driver\MappingDriverChain::class,
                'drivers' => [
                    'Ctt\BlazonCms\Entity' => 'vcms',
                ],
            ],
            'vcms' => [
                'class' => \Doctrine\ORM\Mapping\Driver\AnnotationDriver::class,
                'cache' => 'orm_vcms',
                'paths' => __DIR__ . '/../src/Entity',
            ],
        ],
    ],
    
    'Ctt\BlazonCms\Config' => [
        'db_prefix' => 'ctt_',
        
        'cache' => [
            'adapter' => 'Memory',
            'plugins' => [],
            'options' => [ //'namespace' => 'RcmCache'
            ]
        ]
    ]
];
