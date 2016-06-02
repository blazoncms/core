<?php

namespace Ctt\BlazonCms\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * Page Revision Information Entity
 *
 * This object contains a list of page revisions for use with the
 * content management system.
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
 * @ORM\Table(name="revisions")
 */
class Revision
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
     * @var string Authors name
     *
     * @ORM\Column(type="string", name="author")
     */
    protected $author;
    
    /**
     * @var string Page Layout
     *
     * @ORM\Column(type="boolean", name="published")
     */
    protected $published = false;

    /**
     * @var string Md5 of posted data
     *
     * @ORM\Column(type="string", name="md5", nullable=true)
     */
    protected $md5;

    /**
     * @var ArrayCollection
     *
     * @ORM\ManyToMany(
     *     targetEntity="PluginWrapper",
     *     fetch="EAGER",
     *     cascade={"persist"}
     * )
     * @ORM\JoinTable(
     *     name="revisions_plugin_wrappers",
     *     joinColumns={
     *         @ORM\JoinColumn(
     *             name="revision_id",
     *             referencedColumnName="id",
     *             onDelete="CASCADE"
     *         )
     *     },
     *     inverseJoinColumns={
     *         @ORM\JoinColumn(
     *             name="plugin_wrapper_id",
     *             referencedColumnName="id",
     *             onDelete="CASCADE"
     *         )
     *     }
     * )
     * @ORM\OrderBy({"renderOrder" = "ASC"})
     **/
    protected $pluginWrappers;
    
    /**
     * Constructor for Page Revision Entity.
     */
    public function __construct()
    {
        $this->pluginWrappers = new ArrayCollection();
    }
    
    /**
     * Gets the PageRevId property
     *
     * @return int PageRevId
     *
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @deprecated Do NOT use
     * Set the ID of the Page Revision.  This was added for unit testing and
     * should not be used by calling scripts.  Instead please persist the object
     * with Doctrine and allow Doctrine to set this on it's own.
     *
     * @param int $id Unique Page Revision ID
     *
     * @return null
     *
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * Gets the Author property
     *
     * @return string Author ID
     */
    public function getAuthor()
    {
        return $this->author;
    }

    /**
     * Sets the Author property
     *
     * @param string $author ID for the Author of revision
     *
     * @return null
     */
    public function setAuthor($author)
    {
        $this->author = $author;
    }

    /**
     * Get Plugin Instances - Assumes we have ordered them by RenderOrder the DB join
     *
     * @return ArrayCollection
     */
    public function getPluginWrappers()
    {
        if ($this->pluginWrappers->count() < 1) {
            return [];
        }

        return $this->pluginWrappers;
    }

    /**
     * Add a plugin wrapper to the revision
     *
     * @param PluginWrapper $instanceWrapper Plugin Instance to add to revision.
     *
     * @return null
     */
    public function addPluginWrapper(PluginWrapper $instanceWrapper)
    {
        $this->pluginWrappers->add($instanceWrapper);
    }

    /**
     * Remove Plugin Wrapper from Revision
     *
     * @param PluginWrapper $instance Plugin Wrapper to remove
     *
     * @return void
     */
    public function removeInstance(PluginWrapper $instance)
    {
        $this->pluginWrappers->removeElement($instance);
    }

    /**
     * Publish Revision
     *
     * @return void
     */
    public function publishRevision()
    {
        $this->published = true;
    }

    /**
     * Check if revision was ever published
     *
     * @return boolean
     */
    public function wasPublished()
    {
        return $this->published;
    }

    /**
     * Set saved MD5 of save data
     *
     * @param string $md5 MD5 of saved data
     *
     * @return void
     */
    public function setMd5($md5)
    {
        $this->md5 = $md5;
    }

    /**
     * Get MD5 of saved data
     *
     * @return string
     */
    public function getMd5()
    {
        return $this->md5;
    }
}
