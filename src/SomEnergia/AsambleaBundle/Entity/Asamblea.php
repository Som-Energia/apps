<?php
namespace SomEnergia\AsambleaBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Validator\Constraints as Assert;
use Gedmo\Mapping\Annotation as Gedmo;

/**
 * @ORM\Entity
 * @ORM\Table(name="somenergia_asamblea_asamblea")
 * @ORM\Entity(repositoryClass="SomEnergia\AsambleaBundle\Repository\AsambleaRepository")
 * @UniqueEntity({"nombre", "fecha"})
 * @ORM\HasLifecycleCallbacks
 */
class Asamblea
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @ORM\Column(type="string", length=255, nullable=false)
     */
    protected $nombre;

    /**
     * @ORM\Column(type="date", nullable=false)
     */
    protected $fecha;

    public function getId()
    {
        return $this->id;
    }

    public function setNombre($nombre)
    {
        $this->nombre = $nombre;
    }

    public function getNombre()
    {
        return $this->nombre;
    }

    public function setFecha($fecha)
    {
        $this->fecha = $fecha;
    }

    public function getFecha()
    {
        return $this->fecha;
    }

    public function __toString()
    {
        return $this->getNombre() ? : '---';
    }
}