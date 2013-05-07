<?php

namespace SomEnergia\MailBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Users
 *
 * @ORM\Table(name="users")
 * @ORM\Entity
 */
class Users
{
    /**
     * @var string
     *
     * @ORM\Column(name="id", type="string", length=128, nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=128, nullable=false)
     */
    private $name;

    /**
     * @var integer
     *
     * @ORM\Column(name="uid", type="smallint", nullable=false)
     */
    private $uid;

    /**
     * @var integer
     *
     * @ORM\Column(name="gid", type="smallint", nullable=false)
     */
    private $gid;

    /**
     * @var string
     *
     * @ORM\Column(name="home", type="string", length=255, nullable=false)
     */
    private $home;

    /**
     * @var string
     *
     * @ORM\Column(name="maildir", type="string", length=255, nullable=false)
     */
    private $maildir;

    /**
     * @var boolean
     *
     * @ORM\Column(name="enabled", type="boolean", nullable=false)
     */
    private $enabled;

    /**
     * @var boolean
     *
     * @ORM\Column(name="change_password", type="boolean", nullable=false)
     */
    private $changePassword;

    /**
     * @var string
     *
     * @ORM\Column(name="clear", type="string", length=128, nullable=false)
     */
    private $clear;

    /**
     * @var string
     *
     * @ORM\Column(name="crypt", type="string", length=128, nullable=false)
     */
    private $crypt;

    /**
     * @var string
     *
     * @ORM\Column(name="quota", type="string", length=255, nullable=false)
     */
    private $quota;

    /**
     * @var string
     *
     * @ORM\Column(name="procmailrc", type="string", length=128, nullable=false)
     */
    private $procmailrc;

    /**
     * @var string
     *
     * @ORM\Column(name="spamassassinrc", type="string", length=128, nullable=false)
     */
    private $spamassassinrc;



    /**
     * Get id
     *
     * @return string 
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set name
     *
     * @param string $name
     * @return Users
     */
    public function setName($name)
    {
        $this->name = $name;
    
        return $this;
    }

    /**
     * Get name
     *
     * @return string 
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set uid
     *
     * @param integer $uid
     * @return Users
     */
    public function setUid($uid)
    {
        $this->uid = $uid;
    
        return $this;
    }

    /**
     * Get uid
     *
     * @return integer 
     */
    public function getUid()
    {
        return $this->uid;
    }

    /**
     * Set gid
     *
     * @param integer $gid
     * @return Users
     */
    public function setGid($gid)
    {
        $this->gid = $gid;
    
        return $this;
    }

    /**
     * Get gid
     *
     * @return integer 
     */
    public function getGid()
    {
        return $this->gid;
    }

    /**
     * Set home
     *
     * @param string $home
     * @return Users
     */
    public function setHome($home)
    {
        $this->home = $home;
    
        return $this;
    }

    /**
     * Get home
     *
     * @return string 
     */
    public function getHome()
    {
        return $this->home;
    }

    /**
     * Set maildir
     *
     * @param string $maildir
     * @return Users
     */
    public function setMaildir($maildir)
    {
        $this->maildir = $maildir;
    
        return $this;
    }

    /**
     * Get maildir
     *
     * @return string 
     */
    public function getMaildir()
    {
        return $this->maildir;
    }

    /**
     * Set enabled
     *
     * @param boolean $enabled
     * @return Users
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
     * Set changePassword
     *
     * @param boolean $changePassword
     * @return Users
     */
    public function setChangePassword($changePassword)
    {
        $this->changePassword = $changePassword;
    
        return $this;
    }

    /**
     * Get changePassword
     *
     * @return boolean 
     */
    public function getChangePassword()
    {
        return $this->changePassword;
    }

    /**
     * Set clear
     *
     * @param string $clear
     * @return Users
     */
    public function setClear($clear)
    {
        $this->clear = $clear;
    
        return $this;
    }

    /**
     * Get clear
     *
     * @return string 
     */
    public function getClear()
    {
        return $this->clear;
    }

    /**
     * Set crypt
     *
     * @param string $crypt
     * @return Users
     */
    public function setCrypt($crypt)
    {
        $this->crypt = $crypt;
    
        return $this;
    }

    /**
     * Get crypt
     *
     * @return string 
     */
    public function getCrypt()
    {
        return $this->crypt;
    }

    /**
     * Set quota
     *
     * @param string $quota
     * @return Users
     */
    public function setQuota($quota)
    {
        $this->quota = $quota;
    
        return $this;
    }

    /**
     * Get quota
     *
     * @return string 
     */
    public function getQuota()
    {
        return $this->quota;
    }

    /**
     * Set procmailrc
     *
     * @param string $procmailrc
     * @return Users
     */
    public function setProcmailrc($procmailrc)
    {
        $this->procmailrc = $procmailrc;
    
        return $this;
    }

    /**
     * Get procmailrc
     *
     * @return string 
     */
    public function getProcmailrc()
    {
        return $this->procmailrc;
    }

    /**
     * Set spamassassinrc
     *
     * @param string $spamassassinrc
     * @return Users
     */
    public function setSpamassassinrc($spamassassinrc)
    {
        $this->spamassassinrc = $spamassassinrc;
    
        return $this;
    }

    /**
     * Get spamassassinrc
     *
     * @return string 
     */
    public function getSpamassassinrc()
    {
        return $this->spamassassinrc;
    }
}