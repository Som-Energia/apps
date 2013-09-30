<?php
namespace SomEnergia\SocioBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection as ACollection;
use Doctrine\Common\Collections\Collection as CCollection;
use Symfony\Component\Validator\Constraints as Assert;
use Gedmo\Mapping\Annotation as Gedmo;
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
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @ORM\Column(type="integer", unique=true)
     */
    protected $erpid;

    /**
     * @ORM\Column(type="boolean")
     */
    protected $active;

    /**
     * @ORM\Column(type="string", length=255, nullable=false)
     */
    protected $name;

    /**
     * @ORM\Column(type="string", length=64, nullable=true, unique=true)
     */
    protected $ref;

    /**
     * @ORM\Column(type="string", length=32, nullable=true)
     */
    protected $vat;

    /**
     * @ORM\Column(type="string", length=64, nullable=true)
     */
    protected $phone;

    /**
     * @ORM\Column(type="string", length=128, nullable=true)
     */
    protected $street;

    /**
     * @ORM\Column(type="string", length=128, nullable=true)
     */
    protected $city;

    /**
     * @ORM\Column(type="string", length=24, nullable=true)
     */
    protected $zip;

    /**
     * @ORM\Column(type="string", length=64, nullable=true)
     */
    protected $mobile;

    /**
     * @ORM\Column(type="string", length=240, nullable=true)
     */
    protected $email;

    /**
     * @ORM\Column(type="string", length=32, nullable=true)
     */
    protected $language;

    /**
     * @ORM\Column(type="date", nullable=true)
     */
    protected $fechaAlta;

    /**
     * @ORM\Column(type="date", nullable=true)
     */
    protected $fechaBaja;

    public function getId()
    {
        return $this->id;
    }

    public function setErpid($erpid)
    {
        $this->erpid = $erpid;
    }

    public function getErpid()
    {
        return $this->erpid;
    }

    public function setActive($active)
    {
        $this->active = $active;
    }

    public function getActive()
    {
        return $this->active;
    }

    public function setCity($city)
    {
        $this->city = $city;
    }

    public function getCity()
    {
        return $this->city;
    }

    public function setEmail($email)
    {
        $this->email = $email;
    }

    public function getEmail()
    {
        return $this->email;
    }

    public function setMobile($mobile)
    {
        $this->mobile = $mobile;
    }

    public function getMobile()
    {
        return $this->mobile;
    }

    public function setName($name)
    {
        $this->name = $name;
    }

    public function getName()
    {
        return $this->name;
    }

    public function setPhone($phone)
    {
        $this->phone = $phone;
    }

    public function getPhone()
    {
        return $this->phone;
    }

    public function setRef($ref)
    {
        $this->ref = $ref;
    }

    public function getRef()
    {
        return $this->ref;
    }

    public function setStreet($street)
    {
        $this->street = $street;
    }

    public function getStreet()
    {
        return $this->street;
    }

    public function setVat($vat)
    {
        $this->vat = $vat;
    }

    public function getVat()
    {
        return $this->vat;
    }

    public function setZip($zip)
    {
        $this->zip = $zip;
    }

    public function getZip()
    {
        return $this->zip;
    }

    public function setLanguage($language)
    {
        $this->language = $language;
    }

    public function getLanguage()
    {
        return $this->language;
    }

    /**
     * @param mixed $fechaAlta
     */
    public function setFechaAlta($fechaAlta)
    {
        $this->fechaAlta = $fechaAlta;
    }

    /**
     * @return mixed
     */
    public function getFechaAlta()
    {
        return $this->fechaAlta;
    }

    public function setFechaBaja($fechaBaja)
    {
        $this->fechaBaja = $fechaBaja;
    }

    public function getFechaBaja()
    {
        return $this->fechaBaja;
    }

    public function toLongString()
    {
        return $this->getId() . ' # ' . $this->getErpid() . ' # ' . $this->getActive() . ' # ' . $this->getName() . ' # ' . $this->getRef() . ' # '
             . $this->getVat() . ' # ' . $this->getStreet() . ' # ' . $this->getZip() . ' # ' . $this->getCity() . ' # '
             . $this->getPhone() . ' # ' . $this->getMobile() . ' # ' . $this->getEmail() . ' # ' . $this->getLanguage() . ' # '
             . $this->getFechaAlta()->format('d/m/Y') . ' # '
             . ($this->getFechaBaja()? $this->getFechaBaja()->format('d/m/Y') : '---')
            ;
    }

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
            && $this->fechaAlta == $dest->getFechaAlta()
            //&& $this->fechaBaja == $dest->getFechaBaja()
        ;
    }

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

    public function __toString()
    {
        return $this->getName() ? : '---';
    }
}