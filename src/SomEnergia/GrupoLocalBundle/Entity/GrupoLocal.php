<?php
namespace SomEnergia\GrupoLocalBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Validator\Constraints as Assert;
use Gedmo\Mapping\Annotation as Gedmo;

/**
 * @ORM\Entity
 * @ORM\Table(name="somenergia_grupo_local")
 * @ORM\Entity(repositoryClass="SomEnergia\GrupoLocalBundle\Repository\GrupoLocalRepository")
 * @ORM\HasLifecycleCallbacks
 */
class GrupoLocal
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @ORM\Column(type="string", length=255, nullable=false, unique=true)
     */
    protected $nombre;

    /**
     * @ORM\ManyToMany(targetEntity="SomEnergia\MainBundle\Entity\CodigoPostal", inversedBy="gruposLocales")
     * @ORM\JoinTable(name="somenergia_grupo_local_codigo_postal")
     */
    protected $codigosPostales;

    public function __construct() {
        $this->codigosPostales = new ArrayCollection();
    }

    /**
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set nombre
     *
     * @param string $nombre
     * @return GrupoLocal
     */
    public function setNombre($nombre)
    {
        $this->nombre = $nombre;
    
        return $this;
    }

    /**
     * Get nombre
     *
     * @return string 
     */
    public function getNombre()
    {
        return $this->nombre;
    }

    public function __toString()
    {
        return $this->getNombre() ? $this->getNombre() : '---';
    }
}