<?php

namespace BlazonCms\Core\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Plugin Instances Entity
 *
 * This object contains all the data for a plugin instance.  See documentation for
 * how our plugins work.
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
 * @ORM\Table(name="plugin_instances")
 */
class PluginInstance
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
     * @ORM\Column(type="string", name="name")
     **/
    protected $name;

    /**
     * @var Boolean Site wide instance
     *
     * @ORM\Column(type="boolean", name="is_site_wide")
     */
    protected $siteWide = false;

    /**
     * @var string Name of Site wide Plugin
     *
     * @ORM\Column(type="string", name="display_name", nullable=true)
     */
    protected $displayName = null;

    /**
     * @var string Md5 of posted data
     *
     * @ORM\Column(type="string", name="md5", nullable=true)
     */
    protected $md5 = '';

    /**
     * @var PluginInstance Previous Entity
     *
     * @ORM\OneToOne(targetEntity="PluginInstance")
     * @ORM\JoinColumn(
     *     name="previous_id",
     *     referencedColumnName="id",
     *     onDelete="CASCADE",
     *     nullable=true
     * )
     */
    protected $previous = null;

    /**
     * @var string config that will be stored in the DB as JSON
     *
     * @ORM\Column(type="text", name="config", nullable=true)
     */
    protected $config;
    
    
    /**
     * Get the unique Instance ID
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set the ID of the Plugin Instance.  This was added for unit testing and
     * should not be used by calling scripts.  Instead please persist the object
     * with Doctrine and allow Doctrine to set this on it's own.
     *
     * @param int $id Unique Plugin Instance ID
     *
     * @return null
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * Name of the plugin we are wrapping.  This is used to know what class to
     * call when rendering the instance.
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set the name of the plugin we are wrapping.  This is used to know what class
     * to call when rendering the instance.
     *
     * @param string $name Module Name
     *
     * @return null
     */
    public function setName($name)
    {
        $this->name = $name;
    }

    /**
     * Set this instance as a site wide plugin instance
     *
     * @return null
     */
    public function setSiteWide()
    {
        $this->siteWide = true;
    }

    /**
     * Is this a site wide plugin
     *
     * @return bool
     */
    public function isSiteWide()
    {
        return $this->siteWide;
    }

    /**
     * Get the name to use for the Site Wide plugin
     *
     * @return string Name of Site Wide plugin
     */
    public function getDisplayName()
    {
        return $this->displayName;
    }

    /**
     * Set the name of the Instance to use as a site wide plugin.
     *
     * @param string $name Name to use for the Site wide plugin
     *
     * @return null
     */
    public function setDisplayName($name)
    {
        $this->displayName = $name;
    }

    /**
     * MD5 of save data.  This is used to figure out if we need to create a new
     * instance when saving a plugin.
     *
     * @param string $md5 MD5 of save data
     *
     * @return void
     */
    public function setMd5($md5)
    {
        $this->md5 = $md5;
    }

    /**
     * Current MD5 of save data. This is used to figure out if we need to create a
     * new instance when saving a plugin.
     *
     * @return string
     */
    public function getMd5()
    {
        return $this->md5;
    }

    /**
     * setSaveData
     *
     * @param $saveData
     *
     * @return void
     */
    public function setSaveData($saveData)
    {
        $this->setMd5(md5(serialize($saveData)));
        $this->setConfig($saveData);
    }

    /**
     * Set Previous Plugin Instance.  This is used to keep a record of changes.
     *
     * @param PluginInstance $instance Previous Plugin Instance
     *
     * @return void
     */
    public function setPreviousInstance(PluginInstance $instance)
    {
        $this->previous = $instance;
    }

    /**
     * Get Previous Plugin Instance.  This is used to keep a record of changes.
     *
     * @return PluginInstance
     */
    public function getPreviousInstance()
    {
        return $this->previous;
    }

    /**
     * Gets the config that will be stored in the DB as JSON
     *
     * @return array
     *
     */

    public function getConfig()
    {
        return json_decode($this->config, true);
    }

    /**
     * Sets the config that will be stored in the DB as JSON
     *
     * @param array $config new value test
     *
     * @return null
     *
     */
    public function setConfig($config)
    {
        $this->config = json_encode($config);
    }
}
