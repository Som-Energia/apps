<?php
namespace SomEnergia\AsambleaBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Validator\Constraints as Assert;
use Gedmo\Mapping\Annotation as Gedmo;

/**
 * @ORM\Entity
 * @ORM\Table(name="somenergia_asamblea_asistencia")
 * @ORM\Entity(repositoryClass="SomEnergia\AsambleaBundle\Repository\AsistenciaRepository")
 * @UniqueEntity({"socio", "asamblea", "sede"})
 * @ORM\HasLifecycleCallbacks
 */
class Asistencia
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @ORM\ManyToOne(targetEntity="SomEnergia\SocioBundle\Entity\Socio")
     */
    protected $socio;

    /**
     * @ORM\ManyToOne(targetEntity="SomEnergia\AsambleaBundle\Entity\Asamblea")
     */
    protected $asamblea;

    /**
     * @ORM\ManyToOne(targetEntity="SomEnergia\AsambleaBundle\Entity\Sede")
     */
    protected $sede;

    public function getId()
    {
        return $this->id;
    }

    public function setSocio($socio)
    {
        $this->socio = $socio;
    }

    public function getSocio()
    {
        return $this->socio;
    }

    public function setAsamblea($asamblea)
    {
        $this->asamblea = $asamblea;
    }

    public function getAsamblea()
    {
        return $this->asamblea;
    }

    public function setSede($sede)
    {
        $this->sede = $sede;
    }

    public function getSede()
    {
        return $this->sede;
    }

    public function __toString()
    {
        return $this->getId() ? $this->getId() : '---';
    }
}