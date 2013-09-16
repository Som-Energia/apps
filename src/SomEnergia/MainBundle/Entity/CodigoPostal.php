<?php
namespace SomEnergia\MainBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Gedmo\Mapping\Annotation as Gedmo;

/**
 * @ORM\Entity
 * @ORM\Table(name="somenergia_codigo_postal")
 * @ORM\Entity(repositoryClass="SomEnergia\MainBundle\Repository\CodigoPostalRepository")
 * @ORM\HasLifecycleCallbacks
 */
class CodigoPostal
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @ORM\Column(type="string", length=32, nullable=false, unique=true)
     */
    protected $cp;

    /**
     * @ORM\Column(type="string", length=255, nullable=false)
     */
    protected $poblacion;

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
}