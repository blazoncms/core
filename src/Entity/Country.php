<?php

namespace Ctt\BlazonCms\Entity;

use Ctt\BlazonCms\Exception\InvalidArgumentException;
use Doctrine\ORM\Mapping as ORM;

/**
 * Country Database Entity
 *
 * This object contains ISO country codes as well as a map to the old site
 * countries.  Also contained is a map to internal country codes that may be
 * needed when an API used in the system does not use standard ISO codes
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
 * @ORM\Table(name="countries")
 */
class Country
{
    use TimestampableTrait;
    
    /**
     * @var string ISO Three Digit Country Code
     *
     * @link http://en.wikipedia.org/wiki/ISO_3166-1 ISO Standard
     *
     * @ORM\Column(type="string", length=3)
     * @ORM\Id
     */
    protected $iso3 = 'USA';

    /**
     * @var string ISO Two Digit Country Code
     *
     * @link http://en.wikipedia.org/wiki/ISO_3166-1 ISO Standard
     *
     * @ORM\Column(type="string", length=2, unique = true)
     */
    protected $iso2 = 'US';

    /**
     * @var string Name of Country in English
     *
     * @ORM\Column(type="string", name="name", unique = true)
     */
    protected $name = 'United States';

    /**
     * getId
     *
     * @return string
     */
    public function getId()
    {
        return $this->getIso3();
    }

    /**
     * Sets the CountryName property
     *
     * @param string $name Name of the Country
     *
     * @return null
     *
     */
    public function setName($name)
    {
        $this->name = $name;
    }

    /**
     * Gets the CountryName property
     *
     * @return string CountryName
     *
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Sets the Iso2 property
     *
     * @param string $iso2 ISO2 Country Code
     *
     * @return null
     */
    public function setIso2($iso2)
    {
        if (strlen($iso2) != 2) {
            throw new InvalidArgumentException('ISO2 must be two characters');
        }

        $this->iso2 = $iso2;
    }

    /**
     * Gets the Iso2 property
     *
     * @return string Iso2
     *
     */
    public function getIso2()
    {
        return $this->iso2;
    }

    /**
     * Sets the Iso3 property
     *
     * @param string $iso3 ISO3 Country Code
     *
     * @return null
     * @throws InvalidArgumentException
     */
    public function setIso3($iso3)
    {
        if (strlen($iso3) != 3) {
            throw new InvalidArgumentException('ISO3 must be three characters');
        }

        $this->iso3 = $iso3;
    }

    /**
     * Gets the Iso3 property
     *
     * @return string Iso3
     *
     */
    public function getIso3()
    {
        return $this->iso3;
    }
}
