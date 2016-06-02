<?php

namespace BlazonCms\Core\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * Country Database Entity
 *
 * This object contains registered domains names and also will note which domain
 * name is the primary domain.
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
 * @ORM\Table(name="domains",
 *     indexes={
 *         @ORM\Index(name="domain_name", columns={"domain"})
 *     })
 */
class Domain
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
     * @var string Valid Domain Name
     *
     * @ORM\Column(type="string", name="domain")
     */
    protected $domain;

    /**
     * @var Site
     *
     * @ORM\OneToOne(targetEntity="Site", mappedBy="domain")
     */
    protected $site;

    /**
     * @var Domain Site Object that the domain name belongs
     *                                to.
     *
     * @ORM\ManyToOne(targetEntity="Domain", inversedBy="additionalDomains")
     * @ORM\JoinColumn(
     *     name="primary_id",
     *     referencedColumnName="id",
     *     onDelete="CASCADE"
     * )
     */
    protected $primaryDomain;

    /**
     * @var ArrayCollection Array of Domain Objects that represent
     *                      all the additional domains that belong
     *                      to this one
     *
     * @ORM\OneToMany(targetEntity="Domain", mappedBy="primaryDomain")
     */
    protected $additionalDomains;

    /**
     * @var \Zend\Validator\ValidatorInterface
     */
    protected $domainValidator;

    /**
     * Constructor for Domain Entity.
     */
    public function __construct()
    {
        $this->additionalDomains = new ArrayCollection();
    }

    /**
     * Get the Unique ID of the Domain.
     *
     * @return int Unique Domain ID
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set the ID of the Domain.  This was added for unit testing and should
     * not be used by calling scripts.  Instead please persist the object
     * with Doctrine and allow Doctrine to set this on it's own,
     *
     * @param int $id Unique Domain ID
     *
     * @return void
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * Get the actual domain name.
     *
     * @return string
     */
    public function getDomainName()
    {
        return $this->domain;
    }

    /**
     * Set the domain name
     *
     * @param string $domain Domain name of object
     *
     * @return void
     */
    public function setDomainName($domain)
    {
        $domain = strtolower($domain);

        $this->domain = $domain;
    }

    /**
     * @return Site
     */
    public function getSite()
    {
        return $this->site;
    }

    /**
     * @param Site $site
     */
    public function setSite(Site $site)
    {
        $this->site = $site;
    }

    /**
     * getSiteId
     *
     * @return int|null
     */
    public function getSiteId()
    {
        $site = $this->getSite();
        if (empty($site)) {
            return null;
        }

        return $site->getSiteId();
    }

    /**
     * getPrimaryDomain
     *
     * @return Domain
     */
    public function getPrimaryDomain()
    {
        return $this->primaryDomain;
    }

    /**
     * Set the Primary Domain.
     *
     * @param Domain|null $primaryDomain
     *
     * @return void
     */
    public function setPrimaryDomain($primaryDomain)
    {
        if (empty($primaryDomain)) {
            $this->primaryDomain = null;
            return;
        }

        $this->primaryDomain = $primaryDomain;
    }

    /**
     * isPrimaryDomain
     *
     * @return bool
     */
    public function isPrimaryDomain()
    {
        $primary = $this->getPrimaryDomain();
        if (empty($primary)) {
            return true;
        }

        return false;
    }

    /**
     * @deprecated isPrimaryDomain()
     * Check to see if this domain is the primary domain name.
     *
     * @return bool
     */
    public function isPrimary()
    {
        return $this->isPrimaryDomain();
    }

    /**
     * @deprecated use getPrimaryDomain()
     * Return the Primary Domain.
     *
     * @return Domain
     */
    public function getPrimary()
    {
        return $this->getPrimaryDomain();
    }

    /**
     * @deprecated use
     * Set the Primary Domain.
     *
     * @param Domain $primaryDomain Primary Domain Entity
     *
     * @return void
     */
    public function setPrimary(Domain $primaryDomain)
    {
        $this->setPrimaryDomain($primaryDomain);
    }

    /**
     * Get all the additional domains for domain.
     *
     * @return ArrayCollection Return an Array of Domain Entities.
     */
    public function getAdditionalDomains()
    {
        return $this->additionalDomains;
    }

    /**
     * Add an additional domain to primary
     *
     * @param Domain $domain Domain Entity
     *
     * @return void
     */
    public function setAdditionalDomain(Domain $domain)
    {
        $this->additionalDomains->add($domain);
    }
}
