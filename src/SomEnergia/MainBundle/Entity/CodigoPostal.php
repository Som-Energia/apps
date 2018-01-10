<?php

namespace SomEnergia\MainBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * @ORM\Entity
 * @ORM\Table(name="somenergia_codigo_postal")
 * @ORM\Entity(repositoryClass="SomEnergia\MainBundle\Repository\CodigoPostalRepository")
 * @ORM\HasLifecycleCallbacks
 */
class CodigoPostal
{
    /**
     * @var int
     *
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @var string
     *
     * @ORM\Column(type="string", length=32, nullable=false, unique=true)
     */
    protected $cp;

    /**
     * @var string
     *
     * @ORM\Column(type="string", length=255, nullable=false)
     */
    protected $poblacion;

    /**
     * @var ArrayCollection
     *
     * @ORM\ManyToMany(targetEntity="SomEnergia\GrupoLocalBundle\Entity\GrupoLocal", mappedBy="codigosPostales")
     */
    protected $gruposLocales;

    /**
     * Methods
     */

    /**
     * CodigoPostal constructor.
     */
    public function __construct()
    {
        $this->gruposLocales = new ArrayCollection();
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
     * Set cp
     *
     * @param string $cp
     * @return CodigoPostal
     */
    public function setCp($cp)
    {
        $this->cp = $cp;
    
        return $this;
    }

    /**
     * Get cp
     *
     * @return string 
     */
    public function getCp()
    {
        return $this->cp;
    }

    /**
     * Set poblacion
     *
     * @param string $poblacion
     * @return CodigoPostal
     */
    public function setPoblacion($poblacion)
    {
        $this->poblacion = $poblacion;
    
        return $this;
    }

    /**
     * Get poblacion
     *
     * @return string 
     */
    public function getPoblacion()
    {
        return $this->poblacion;
    }

    public function __toString()
    {
        return $this->getPoblacion() ? $this->getCp() . ' ' . $this->getPoblacion() : '---';
    }

    /**
     * Add gruposLocales
     *
     * @param \SomEnergia\GrupoLocalBundle\Entity\GrupoLocal $gruposLocales
     * @return CodigoPostal
     */
    public function addGruposLocale(\SomEnergia\GrupoLocalBundle\Entity\GrupoLocal $gruposLocales)
    {
        $this->gruposLocales[] = $gruposLocales;
    
        return $this;
    }

    /**
     * Remove gruposLocales
     *
     * @param \SomEnergia\GrupoLocalBundle\Entity\GrupoLocal $gruposLocales
     */
    public function removeGruposLocale(\SomEnergia\GrupoLocalBundle\Entity\GrupoLocal $gruposLocales)
    {
        $this->gruposLocales->removeElement($gruposLocales);
    }

    /**
     * Get gruposLocales
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getGruposLocales()
    {
        return $this->gruposLocales;
    }
}