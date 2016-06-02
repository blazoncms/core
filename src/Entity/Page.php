<?php

namespace BlazonCms\Core\Entity;

use BlazonCms\Core\Exception\InvalidArgumentException;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * Page Information Entity
 *
 * This object contains a list of pages for use with the content managment
 * system.
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
 * @ORM\Table(name="pages",
 *     indexes={
 *         @ORM\Index(name="page_name", columns={"name"})
 *     }
 * )
 */
class Page extends ContainerAbstract
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
     * @var string Page name
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
     * @var string Page Layout
     *
     * @ORM\Column(type="string", name="page_layout", nullable=true)
     */
    protected $pageLayout = null;

    /**
     * @var string Default Site Layout
     *
     * @ORM\Column(type="string", name="site_layout_override", nullable=true)
     */
    protected $siteLayoutOverride = null;

    /**
     * @var Revision Integer Current Page Revision ID
     *
     * @ORM\OneToOne(targetEntity="Revision")
     * @ORM\JoinColumn(name="published_revision_id", referencedColumnName="id")
     */
    protected $publishedRevision;

    /**
     * @var Revision Integer Staged Revision ID
     *
     * @ORM\OneToOne(targetEntity="Revision")
     * @ORM\JoinColumn(name="staged_revision_id", referencedColumnName="id")
     */
    protected $stagedRevision;

    /**
     * @ORM\ManyToOne(targetEntity="PageType")
     * @ORM\JoinColumn(name="page_type", referencedColumnName="type")
     */
    protected $pageType = 'n';

    /**
     * @var Site
     *
     * @ORM\ManyToOne(targetEntity="Site", inversedBy="pages")
     * @ORM\JoinColumn(name="site_id", referencedColumnName="id")
     **/
    protected $site;

    /**
     * @var ArrayCollection
     *
     * @ORM\ManyToMany(
     *     targetEntity="Revision",
     *     indexBy="id",
     *     cascade={"persist"}
     * )
     * @ORM\JoinTable(
     *     name="pages_revisions",
     *     joinColumns={
     *         @ORM\JoinColumn(
     *             name="page_id",
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
     * @var Page
     *
     * @ORM\ManyToOne(targetEntity="Page")
     * @ORM\JoinColumn(
     *     name="parent_id",
     *     referencedColumnName="id",
     *     onDelete="CASCADE",
     *     nullable=true
     * )
     */
    protected $parent;

    /**
     * Constructor for Page Entity.
     */
    public function __construct()
    {
        $this->revisions = new ArrayCollection();
    }
    
    /**
     * Gets the Name property
     *
     * @return string Name
     *
     */
    public function getName()
    {
        return strtolower($this->name);
    }

    /**
     * Sets the Name property
     *
     * @param string $name Name of Page.  Should be URL friendly and should not
     *                     included spaces.
     *
     * @return string
     *
     * @throws InvalidArgumentException Exception thrown if name contains spaces.
     */
    public function setName($name)
    {
        $name = strtolower($name);

        //Check for everything except letters and dashes.  Throw exception if any are found.
        if (preg_match("/[^a-z\-0-9\.]/", $name)) {
            throw new InvalidArgumentException(
                'Page names can only contain letters, numbers, dots, and dashes.'
                . ' No spaces. This page name is invalid: ' . $name
            );
        }

        $this->name = $name;
    }

    /**
     * Set the type of page
     *
     * @param string $type Type to set
     *
     * @return void
     * @throws InvalidArgumentException
     */
    public function setPageType($type)
    {
        if (strlen($type) > 32) {
            throw new InvalidArgumentException(
                'Page type can not exceed 32 character'
            );
        }

        $this->pageType = strtolower($type);
    }

    /**
     * Get type of page.
     *
     * @return string
     */
    public function getPageType()
    {
        return $this->pageType;
    }

    /**
     * Set the zend page template to use for the page
     *
     * @param string $pageLayout page template to use.
     *
     * @return void
     */
    public function setPageLayout($pageLayout)
    {
        $this->pageLayout = $pageLayout;
    }

    /**
     * Get the zend page template to use for the page
     *
     * @return string
     */
    public function getPageLayout()
    {
        return $this->pageLayout;
    }

    /**
     * Override the sites layout template
     *
     * @param string $layout page template to use.
     *
     * @return void
     */
    public function setSiteLayoutOverride($layout)
    {
        if ($layout === 'default') {
            $layout = null;
        }

        $this->siteLayoutOverride = $layout;
    }

    /**
     * Get the site layout override for this page
     *
     * @return string
     */
    public function getSiteLayoutOverride()
    {
        return $this->siteLayoutOverride;
    }

    /**
     * Set the parent page.  Used to generate breadcrumbs or navigation
     *
     * @param Page $parent Parent Page Entity
     *
     * @return void
     */
    public function setParent(Page $parent)
    {
        $this->parent = $parent;
    }

    /**
     * Get the parent page
     *
     * @return Page
     */
    public function getParent()
    {
        return $this->parent;
    }
}
