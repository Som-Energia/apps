<?php

namespace SomEnergia\SocioBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\Collection as CCollection;
use SomEnergia\MainBundle\Entity\CodigoPostal;

/**
 * @ORM\Entity
 * @ORM\Table(name="somenergia_socio_socio")
 * @ORM\Table(indexes={@ORM\Index(name="erpid_idx", columns={"erpid"})})
 * @ORM\Entity(repositoryClass="SomEnergia\SocioBundle\Repository\SocioRepository")
 * @ORM\HasLifecycleCallbacks
 */
class Socio
{
    /**
     * @var integer
     *
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @var integer
     *
     * @ORM\Column(type="integer", unique=true)
     */
    protected $erpid;

    /**
     * @var boolean
     *
     * @ORM\Column(type="boolean")
     */
    protected $active;

    /**
     * @var string
     *
     * @ORM\Column(type="string", length=255, nullable=false)
     */
    protected $name;

    /**
     * @var string
     *
     * @ORM\Column(type="string", length=64, nullable=true, unique=true)
     */
    protected $ref;

    /**
     * @var string
     *
     * @ORM\Column(type="string", length=32, nullable=true)
     */
    protected $vat;

    /**
     * @var string
     *
     * @ORM\Column(type="string", length=64, nullable=true)
     */
    protected $phone;

    /**
     * @var string
     *
     * @ORM\Column(type="string", length=128, nullable=true)
     */
    protected $street;

    /**
     * @var string
     *
     * @ORM\Column(type="string", length=128, nullable=true)
     */
    protected $city;

    /**
     * @var string
     *
     * @ORM\Column(type="string", length=24, nullable=true)
     */
    protected $zip;

    /**
     * @var string
     *
     * @ORM\Column(type="string", length=64, nullable=true)
     */
    protected $mobile;

    /**
     * @var string
     *
     * @ORM\Column(type="string", length=240, nullable=true)
     */
    protected $email;

    /**
     * @var string
     *
     * @ORM\Column(type="string", length=32, nullable=true)
     */
    protected $language;

    /**
     * @var \DateTime
     *
     * @ORM\Column(type="date", nullable=true)
     */
    protected $fechaAlta;

    /**
     * @var \DateTime
     *
     * @ORM\Column(type="date", nullable=true)
     */
    protected $fechaBaja;

    /**
     * Methods
     */

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param int $erpid
     */
    public function setErpid($erpid)
    {
        $this->erpid = $erpid;
    }

    /**
     * @return int
     */
    public function getErpid()
    {
        return $this->erpid;
    }

    /**
     * @param boolean $active
     */
    public function setActive($active)
    {
        $this->active = $active;
    }

    /**
     * @return bool
     */
    public function getActive()
    {
        return $this->active;
    }

    /**
     * @param string $city
     */
    public function setCity($city)
    {
        $this->city = $city;
    }

    /**
     * @return string
     */
    public function getCity()
    {
        return $this->city;
    }

    /**
     * @param string $email
     */
    public function setEmail($email)
    {
        $this->email = $email;
    }

    /**
     * @return string
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * @param string $mobile
     */
    public function setMobile($mobile)
    {
        $this->mobile = $mobile;
    }

    /**
     * @return string
     */
    public function getMobile()
    {
        return $this->mobile;
    }

    /**
     * @param string $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param string $phone
     */
    public function setPhone($phone)
    {
        $this->phone = $phone;
    }

    /**
     * @return string
     */
    public function getPhone()
    {
        return $this->phone;
    }

    /**
     * @param string $ref
     */
    public function setRef($ref)
    {
        $this->ref = $ref;
    }

    /**
     * @return string
     */
    public function getRef()
    {
        return $this->ref;
    }

    /**
     * @param string $street
     */
    public function setStreet($street)
    {
        $this->street = $street;
    }

    /**
     * @return string
     */
    public function getStreet()
    {
        return $this->street;
    }

    /**
     * @param string $vat
     */
    public function setVat($vat)
    {
        $this->vat = $vat;
    }

    /**
     * @return string
     */
    public function getVat()
    {
        return $this->vat;
    }

    /**
     * @param string $zip
     */
    public function setZip($zip)
    {
        $this->zip = $zip;
    }

    /**
     * @return string
     */
    public function getZip()
    {
        return $this->zip;
    }

    /**
     * @param string $language
     */
    public function setLanguage($language)
    {
        $this->language = $language;
    }

    /**
     * @return string
     */
    public function getLanguage()
    {
        return $this->language;
    }

    /**
     * @param \DateTime $fechaAlta
     */
    public function setFechaAlta($fechaAlta)
    {
        $this->fechaAlta = $fechaAlta;
    }

    /**
     * @return \DateTime
     */
    public function getFechaAlta()
    {
        return $this->fechaAlta;
    }

    /**
     * @param \DateTime $fechaBaja
     */
    public function setFechaBaja($fechaBaja)
    {
        $this->fechaBaja = $fechaBaja;
    }

    /**
     * @return \DateTime
     */
    public function getFechaBaja()
    {
        return $this->fechaBaja;
    }

    /**
     * @return string
     */
    public function toLongString()
    {
        return $this->getId() . ' # ' . $this->getErpid() . ' # ' . $this->getActive() . ' # ' . $this->getName() . ' # ' . $this->getRef() . ' # '
             . $this->getVat() . ' # ' . $this->getStreet() . ' # ' . $this->getZip() . ' # ' . $this->getCity() . ' # '
             . $this->getPhone() . ' # ' . $this->getMobile() . ' # ' . $this->getEmail() . ' # ' . $this->getLanguage() . ' # '
             . $this->getFechaAlta()->format('d/m/Y') . ' # '
             . ($this->getFechaBaja()? $this->getFechaBaja()->format('d/m/Y') : '---')
            ;
    }

    /**
     * @param Socio $dest
     *
     * @return bool
     */
    public function isEqual(Socio $dest) {
        return $this->erpid == $dest->getErpid()
            && $this->active == $dest->getActive()
            && $this->name == $dest->getName()
            && $this->ref == $dest->getRef()
            && $this->vat == $dest->getVat()
            && $this->phone == $dest->getPhone()
            && $this->street == $dest->getStreet()
            && $this->city == $dest->getCity()
            && $this->zip == $dest->getZip()
            && $this->mobile == $dest->getMobile()
            && $this->email == $dest->getEmail()
            && $this->language == $dest->getLanguage()
            //&& $this->fechaAlta == $dest->getFechaAlta()
            //&& $this->fechaBaja == $dest->getFechaBaja()
        ;
    }

    /**
     * @param CCollection $zipCodes
     *
     * @return bool
     */
    public function containsAZipCodeOf(CCollection $zipCodes)
    {
        $found = false;
        /** @var CodigoPostal $zipCode */
        foreach ($zipCodes as $zipCode) {
            if ($zipCode->getCp() == $this->getZip()) {
                $found = true;
                break;
            }
        }

        return $found;
    }

    /**
     * @return string
     */
    public function __toString()
    {
        return $this->getName() ? : '---';
    }
}