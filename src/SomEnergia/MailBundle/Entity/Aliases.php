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
     * @ORM\Column(name="mail", type="string", length=120, unique=true, nullable=false)
     * @Assert\Email()
     */
    private $mail;

    /**
     * @var string
     *
     * @ORM\Column(name="destination", type="string", length=255, nullable=false)
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
        $this->mail = str_replace(' ', '', $mail);
    
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
     * @return Aliases parsed and wel formed
     */
    public function setDestination($destination)
    {
        $destination = str_replace(' ', '', $destination); // remove white spaces
        $items = explode(',', $destination); // trunk string into an array of emails
        $this->destination = '';

        foreach ($items as $item) {
            if (filter_var($item, FILTER_VALIDATE_EMAIL)) {
                $this->destination .= $item . ',';
            }
        }
        if (strlen($this->destination) > 0) $this->destination = substr($this->destination, 0, -1); // remove last comma

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