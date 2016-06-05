<?php

namespace BlazonCms\Core\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Doctrine Entity for CMS Users
 *
 * @ORM\Entity
 * @ORM\Table(name="users")
 */
class User
{
    use TimestampableTrait;

    /**
     * @var int Auto-Incremented Primary Key
     *
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue
     */
    protected $id;

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param int $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }
}
