<?php

namespace BlazonCms\Core\Entity;

/**
 * Container Abstract.  Contains methods shared by container classes
 *
 * Interface for containers.  This class defines shared methods and properties for
 * container classes.  Please note that if using doctrine the properties need to
 * still be defined by the actual class as well.
 *
 * @category  Reliv
 * @package   Rcm
 * @author    Westin Shafer <wshafer@relivinc.com>
 * @copyright 2012 Reliv International
 * @license   License.txt New BSD License
 * @version   Release: 1.0
 * @link      http://github.com/reliv
 * @SuppressWarnings(PHPMD.ExcessiveClassComplexity)
 */
interface ContainerInterface
{
    /**
     * Gets the Name property
     *
     * @return string Name
     *
     */
    public function getName();

    /**
     * Sets the Name property
     *
     * @param string $name Name of Page.  Should be URL friendly and should not
     *                     included spaces.
     *
     * @return null
     */
    public function setName($name);

    /**
     * Gets the Author property
     *
     * @return string Author
     */
    public function getAuthor();

    /**
     * Sets the Author property
     *
     * @param string $author ID of Author.
     *
     * @return null
     */
    public function setAuthor($author);
    
    /**
     * Get Published Revision
     *
     * @return Revision
     */
    public function getPublishedRevision();

    /**
     * Set the current published revision for the page
     *
     * @param Revision $revision Revision object to add
     *
     * @return null
     */
    public function setPublishedRevision(Revision $revision);

    /**
     * Gets the Current Staged property
     *
     * @return Revision CurrentRevision
     */
    public function getStagedRevision();

    /**
     * Sets the current staged property
     *
     * @param Revision $revision Revision object to add
     *
     * @return null
     */
    public function setStagedRevision(Revision $revision);

    /**
     * Remove Published Revision
     *
     * @return void
     */
    public function removePublishedRevision();

    /**
     * Remove Staged Revision
     *
     * @return void
     */
    public function removeStagedRevision();

    /**
     * Get the site that uses this page.
     *
     * @return Site
     */
    public function getSite();

    /**
     * Set site the page belongs to
     *
     * @param Site $site Site object to add
     *
     * @return void
     */
    public function setSite(Site $site);

    /**
     * Set Page Revision
     *
     * @param Revision $revision Revision object to add
     *
     * @return void
     */
    public function addRevision(Revision $revision);

    /**
     * Get the entire revision list
     *
     * @return \Doctrine\Common\Collections\ArrayCollection
     */
    public function getRevisions();

    /**
     * Overwrite current revisions and Set a group of revisions
     *
     * @param array $revisions Array of Revisions to be added
     */
    public function setRevisions(array $revisions);
}
