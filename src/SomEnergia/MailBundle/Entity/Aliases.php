<?php

namespace SomEnergia\MailBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Aliases
 *
 * @ORM\Table(name="aliases")
 * @ORM\Entity
 */
class Aliases
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
     * @ORM\Column(name="mail", type="string", length=120, nullable=false)
     * @Assert\Email()
     */
    private $mail;

    /**
     * @var string
     *
     * @ORM\Column(name="destination", type="string", length=120, nullable=false)
     */
    private $destination;

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
     * Set mail
     *
     * @param string $mail
     * @return Aliases
     */
    public function setMail($mail)
    {
        $this->mail = $mail;
    
        return $this;
    }

    /**
     * Get mail
     *
     * @return string 
     */
    public function getMail()
    {
        return $this->mail;
    }

    /**
     * Set destination
     *
     * @param string $destination
     * @return Aliases
     */
    public function setDestination($destination)
    {
        $this->destination = $destination;
    
        return $this;
    }

    /**
     * Get destination
     *
     * @return string 
     */
    public function getDestination()
    {
        return $this->destination;
    }

    /**
     * Set enabled
     *
     * @param boolean $enabled
     * @return Aliases
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

    /**
     * @return string mail property if it is set
     */
    public function __toString()
    {
        return $this->getMail() ? : '---';
    }
}