<?php

namespace BlazonCms\Core\EventListener;

use Doctrine\Common\EventSubscriber;
use Doctrine\ORM\Event\LoadClassMetadataEventArgs;
use Interop\Container\ContainerInterface;

class DoctrineEventSubscriber implements EventSubscriber
{
    /** @var ContainerInterface */
    protected $container;

    public function __invoke(ContainerInterface $container)
    {
        $this->container = $container;
        return $this;
    }

    public function getSubscribedEvents()
    {
        return [\Doctrine\ORM\Events::loadClassMetadata];
    }

    public function loadClassMetadata(LoadClassMetadataEventArgs $eventArgs)
    {
        $classMetadata = $eventArgs->getClassMetadata();

        if (!$classMetadata->isInheritanceTypeSingleTable()
            || $classMetadata->getName() === $classMetadata->rootEntityName
        ) {
            $classMetadata->setTableName($this->getPrefix() . $classMetadata->getTableName());
        }

        foreach ($classMetadata->getAssociationMappings() as $fieldName => $mapping) {
            if ($mapping['type'] == \Doctrine\ORM\Mapping\ClassMetadataInfo::MANY_TO_MANY
                && $mapping['isOwningSide']
            ) {
                $mappedTableName = $mapping['joinTable']['name'];
                $classMetadata->associationMappings[$fieldName]['joinTable']['name']
                    = $this->getPrefix() . $mappedTableName;
            }
        }
    }
    
    public function getPrefix()
    {
        $config = $this->container->has('config') ? $this->container->get('config') : [];
        
        if (!empty($config['BlazonCms\Core\Config']['db_prefix'])) {
            return $config['BlazonCms\Core\Config']['db_prefix'];
        }

        return '';
    }
}
