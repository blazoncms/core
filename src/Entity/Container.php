<?php

namespace Ctt\BlazonCms\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * Page Information Entity
 *
 * This is a Doctrine 2 definition file for plugin containers.  This file
 * is used for any module that needs to know container information.
 *
 * @category  Reliv
 * @package   Rcm
 * @author    Westin Shafer <wshafer@relivinc.com>
 * @copyright 2012 Reliv International
 * @license   License.txt New BSD License
 * @version   Release: 1.0
 * @link      http://github.com/reliv
 *
 * @ORM\Entity
 * @ORM\Table (
 *     name="containers",
 *     uniqueConstraints={
 *         @ORM\UniqueConstraint(
 *             name="uq_name_site",
 *             columns={"name", "id"}
 *         )
 *     },
 *     indexes={
 *         @ORM\Index(name="container_name", columns={"name"})
 *     }
 * )
 *
 */
class Container extends ContainerAbstract
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
     * @var string Container name
     *
     * @ORM\Column(type="string", name="name")
     */
    protected $name;

    /**
     * @var string Authors name
     *
     * @ORM\Column(type="string", name="author")
     */
    protected $author;

    /**
     * @var Revision Integer Current Page Revision ID
     *
     * @ORM\OneToOne(targetEntity="Revision")
     * @ORM\JoinColumn(name="published_revision_id", referencedColumnName="id")
     */
    protected $publishedRevision;

    /**
     * @var int
     *
     * @ORM\Column(type="integer", name="published_revision_id", nullable=true)
     */
    protected $publishedRevisionId;

    /**
     * @var Revision Integer Staged Revision ID
     *
     * @ORM\OneToOne(targetEntity="Revision")
     * @ORM\JoinColumn(name="staged_revision_id", referencedColumnName="id")
     */
    protected $stagedRevision;

    /**
     * @var int
     *
     * @ORM\Column(type="integer", name="staged_revision_id", nullable=true)
     */
    protected $stagedRevisionId;

    /**
     * @var Site
     *
     * @ORM\ManyToOne(targetEntity="Site", inversedBy="containers")
     * @ORM\JoinColumn(name="site_id", referencedColumnName="id")
     **/
    protected $site;
    

    /**
     * @ORM\ManyToMany(
     *     targetEntity="Revision",
     *     indexBy="revisionId",
     *     cascade={"persist"}
     * )
     * @ORM\JoinTable(
     *     name="containers_revisions",
     *     joinColumns={
     *         @ORM\JoinColumn(
     *             name="container_id",
     *             referencedColumnName="id",
     *             onDelete="CASCADE"
     *         )
     *     },
     *     inverseJoinColumns={
     *         @ORM\JoinColumn(
     *             name="revision_id",
     *             referencedColumnName="id",
     *             onDelete="CASCADE"
     *         )
     *     }
     * )
     **/
    protected $revisions;

    /**
     * Constructor for Page Entity.  Adds a hydrator to site reference
     */
    public function __construct()
    {
        $this->revisions = new ArrayCollection();
    }

    /**
     * Get the current Page ID
     *
     * @return int Unique page ID number
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @deprecated Do NOT use
     * Set the ID of the Page.  This was added for unit testing and should
     * not be used by calling scripts.  Instead please persist the object
     * with Doctrine and allow Doctrine to set this on it's own,
     *
     * @param int $id Unique Page ID
     *
     * @return void
     */
    public function setId($id)
    {
        $this->id = $id;
    }
}
