<?php

namespace SomEnergia\MainBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use SomEnergia\GrupoLocalBundle\Entity\GrupoLocal;

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
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param string $cp
     *
     * @return CodigoPostal
     */
    public function setCp($cp)
    {
        $this->cp = $cp;
    
        return $this;
    }

    /**
     * @return string
     */
    public function getCp()
    {
        return $this->cp;
    }

    /**
     * @param string $poblacion
     *
     * @return CodigoPostal
     */
    public function setPoblacion($poblacion)
    {
        $this->poblacion = $poblacion;
    
        return $this;
    }

    /**
     * @return string
     */
    public function getPoblacion()
    {
        return $this->poblacion;
    }

    /**
     * @param GrupoLocal $gruposLocales
     *
     * @return CodigoPostal
     */
    public function addGruposLocale(GrupoLocal $gruposLocales)
    {
        $this->gruposLocales[] = $gruposLocales;
    
        return $this;
    }

    /**
     * @param GrupoLocal $gruposLocales
     */
    public function removeGruposLocale(GrupoLocal $gruposLocales)
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

    /**
     * @return string
     */
    public function __toString()
    {
        return $this->getPoblacion() ? $this->getCp() . ' ' . $this->getPoblacion() : '---';
    }
}
