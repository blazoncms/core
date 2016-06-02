<?php

namespace Ctt\BlazonCms\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Site redirects
 *
 * This object contains a list of urls to redirect. For use with the content
 * management system.
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
 * @ORM\Table(name="redirects",
 *     indexes={
 *         @ORM\Index(name="redirect_request_url", columns={"request_url"})
 *     }
 * )
 */
class Redirect
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
     * @var string Request URL
     *
     * @ORM\Column(type="string", name="request_url")
     */
    protected $requestUrl;

    /**
     * @var string Redirect URL
     *
     * @ORM\Column(type="string", name="redirect_url")
     */
    protected $redirectUrl;

    /**
     * @var Site
     *
     * @ORM\ManyToOne(targetEntity="Site")
     * @ORM\JoinColumn(
     *     name="site_id",
     *     referencedColumnName="id",
     *     onDelete="CASCADE"
     * )
     **/
    protected $site;

    /**
     * @deprecated Do NOT use
     * Set the Redirect Id.  This was added for unit testing and
     * should not be used by calling scripts.  Instead please persist the object
     * with Doctrine and allow Doctrine to set this on it's own.
     *
     * @param int $id Redirect ID
     *
     * @return void
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * Get the Redirect Id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set the Redirect URL
     *
     * @param string $redirectUrl Redirect URL
     *
     * @return void
     */
    public function setRedirectUrl($redirectUrl)
    {
        $this->redirectUrl = $redirectUrl;
    }

    /**
     * Get Redirect URL
     *
     * @return string
     */
    public function getRedirectUrl()
    {
        return $this->redirectUrl;
    }

    /**
     * Set the Request URL to redirect
     *
     * @param string $requestUrl Request URL to redirect
     *
     * @return void
     * @throws \Exception
     */
    public function setRequestUrl($requestUrl)
    {
        $this->requestUrl = $requestUrl;
    }

    /**
     * Return the Request URL to Redirect
     *
     * @return string
     */
    public function getRequestUrl()
    {
        return $this->requestUrl;
    }

    /**
     * Set the Site the redirect belongs to
     *
     * @param Site $site Site Entity
     *
     * @return void
     */
    public function setSite($site)
    {
        if ($site === null) {
            $this->site = null;
            return;
        }

        $this->site = $site;
    }

    /**
     * Get the site the redirect belongs to
     *
     * @return Site
     */
    public function getSite()
    {
        return $this->site;
    }
}
