<?php

namespace SomEnergia\MailBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Domains
 *
 * @ORM\Table(name="domains")
 * @ORM\Entity
 */
class Domains
{
    /**
     * @var integer
     *
     * @ORM\Column(name="pkid", type="smallint", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $pkid;

    /**
     * @var string
     *
     * @ORM\Column(name="domain", type="string", length=120, nullable=false)
     */
    private $domain;

    /**
     * @var string
     *
     * @ORM\Column(name="transport", type="string", length=120, nullable=false)
     */
    private $transport;

    /**
     * @var boolean
     *
     * @ORM\Column(name="enabled", type="boolean", nullable=false)
     */
    private $enabled;



    /**
     * Get pkid
     *
     * @return integer 
     */
    public function getPkid()
    {
        return $this->pkid;
    }

    /**
     * Set domain
     *
     * @param string $domain
     * @return Domains
     */
    public function setDomain($domain)
    {
        $this->domain = $domain;
    
        return $this;
    }

    /**
     * Get domain
     *
     * @return string 
     */
    public function getDomain()
    {
        return $this->domain;
    }

    /**
     * Set transport
     *
     * @param string $transport
     * @return Domains
     */
    public function setTransport($transport)
    {
        $this->transport = $transport;
    
        return $this;
    }

    /**
     * Get transport
     *
     * @return string 
     */
    public function getTransport()
    {
        return $this->transport;
    }

    /**
     * Set enabled
     *
     * @param boolean $enabled
     * @return Domains
     */
    public function setEnabled($enabled)
    {
        $this->enabled = $enabled;
    
        return $this;
    }

    /**
     * Get enabled
     *
     * @return boolean 
     */
    public function getEnabled()
    {
        return $this->enabled;
    }
}