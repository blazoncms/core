<?php

namespace BlazonCms\Core\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Plugin Wrapper Entity
 *
 * Plugin Wrapper Entity.  Used for positioning within containers.
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
 * @ORM\Table(name="plugin_wrappers")
 */
class PluginWrapper
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
     * @var integer Layout Placement.  This is used only for Page Containers.
     *
     * @ORM\Column(type="string", name="layout_container", nullable=true)
     */
    protected $layoutContainer = null;

    /**
     * @var integer Order of Layout Placement
     *
     * @ORM\Column(type="integer", name="render_order")
     */
    protected $renderOrder = 0;
    
    /**
     * @var int Row Number
     *
     * @ORM\Column(type="integer", name="row", options={"default":0})
     */
    protected $row = 0;

    /**
     * @var string Column CSS Class
     *
     * @ORM\Column(type="string", name="column_class", options={"default":"col-sm-12"})
     */
    protected $columnClass = 'col-sm-12';
    

    /**
     * @var PluginInstance
     *
     * @ORM\ManyToOne(
     *     targetEntity="PluginInstance",
     *     fetch="EAGER",
     *     cascade={"persist"}
     * )
     * @ORM\JoinColumn(
     *      name="plugin_instance_id",
     *      referencedColumnName="id",
     *      onDelete="CASCADE"
     * )
     **/
    protected $instance;
    

    /**
     * @deprecated Don NOT use this
     * Set the Plugin Wrapper ID.  This was added for unit testing and
     * should not be used by calling scripts.  Instead please persist the object
     * with Doctrine and allow Doctrine to set this on it's own.
     *
     * @param int $id Plugin Wrapper ID
     *
     * @return void
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * Get the Plugin Wrapper ID
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Get Instance layout container
     *
     * @return int
     */
    public function getLayoutContainer()
    {
        return $this->layoutContainer;
    }

    /**
     * Set Layout Container.. Or Container that this plugin should display in.
     * These are defined in the PageLayouts and displayed using a view helper.
     *
     * @param int $container The container ID number to display in.
     *
     * @return null
     */
    public function setLayoutContainer($container)
    {
        $this->layoutContainer = $container;
    }

    /**
     * Get Order number to render instances that have the same container
     *
     * @return int
     */
    public function getRenderOrder()
    {
        return (int)$this->renderOrder;
    }

    /**
     * Set the order number to render instances that have the same container.
     *
     * @param $renderOrder
     *
     * @return void
     */
    public function setRenderOrder($renderOrder)
    {
        $this->renderOrder = (int)$renderOrder;
    }

    /**
     * Set the plugin instance to be wrapped
     *
     * @param PluginInstance $instance Instance to wrap
     *
     * @return void
     */
    public function setInstance(PluginInstance $instance)
    {
        $this->instance = $instance;
    }

    /**
     * Get the Wrapped Plugin Instance
     *
     * @return PluginInstance
     */
    public function getInstance()
    {
        return $this->instance;
    }

    /**
     * setRowNumber
     *
     * @param int $row
     *
     * @return void
     */
    public function setRow($row)
    {
        $this->row = (int)$row;
    }

    /**
     * getRowNumber
     *
     * @return int
     */
    public function getRow()
    {
        return (int)$this->row;
    }

    /**
     * setColumnClass
     *
     * @param string $columnClass
     *
     * @return void
     */
    public function setColumnClass($columnClass)
    {
        $this->columnClass = trim((string)$columnClass);
    }

    /**
     * getColumnClass
     *
     * @return string
     */
    public function getColumnClass()
    {
        return trim((string)$this->columnClass);
    }
}
