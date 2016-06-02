<?php

namespace Ctt\BlazonCms\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Page Type Information Entity
 *
 * @ORM\Entity
 * @ORM\Table(name="page_types")
 */
class PageType
{
    use TimestampableTrait;
    
    /**
     * @var int Auto-Incremented Primary Key
     *
     * @ORM\Id
     * @ORM\Column(type="string", length=32)
     */
    protected $type;

    /**
     * @var string Page name
     *
     * @ORM\Column(type="string", name="name")
     */
    protected $name;
}
