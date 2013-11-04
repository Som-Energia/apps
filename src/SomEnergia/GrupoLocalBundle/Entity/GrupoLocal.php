<?php
namespace SomEnergia\GrupoLocalBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Validator\Constraints as Assert;
use Gedmo\Mapping\Annotation as Gedmo;
use SomEnergia\MainBundle\Entity\CodigoPostal;

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

    /**
     * @ORM\OneToMany(targetEntity="Application\Sonata\UserBundle\Entity\User", mappedBy="grupoLocal")
     */
    protected $users;

    public function __construct() {
        $this->codigosPostales = new ArrayCollection();
        $this->users = new ArrayCollection();
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

    /**
     * Add codigosPostales
     *
     * @param \SomEnergia\MainBundle\Entity\CodigoPostal $codigosPostales
     * @return GrupoLocal
     */
    public function addCodigosPostale(\SomEnergia\MainBundle\Entity\CodigoPostal $codigosPostales)
    {
        $this->codigosPostales[] = $codigosPostales;
    
        return $this;
    }

    /**
     * Remove codigosPostales
     *
     * @param \SomEnergia\MainBundle\Entity\CodigoPostal $codigosPostales
     */
    public function removeCodigosPostale(\SomEnergia\MainBundle\Entity\CodigoPostal $codigosPostales)
    {
        $this->codigosPostales->removeElement($codigosPostales);
    }

    /**
     * Get codigosPostales
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getCodigosPostales()
    {
        return $this->codigosPostales;
    }

    /**
     * Determina si el ID del codigo postal pasado por parametro
     *  existe dentro de la coleccion de codigos postales que pertenecen al grupo local
     *
     * @param $pcid
     * @return bool
     */
    public function hasPostalCode($pcid)
    {
        $found = false;
        $postalCodes = $this->getCodigosPostales();
        /** @var CodigoPostal $postalCode */
        foreach ($postalCodes as $postalCode) {
            if ($postalCode->getId() == $pcid) {
                $found = true;
                break;
            }
        }

        return $found;
    }

    /**
     * Add users
     *
     * @param \Application\Sonata\UserBundle\Entity\User $users
     * @return GrupoLocal
     */
    public function addUser(\Application\Sonata\UserBundle\Entity\User $users)
    {
        $this->users[] = $users;
    
        return $this;
    }

    /**
     * Remove users
     *
     * @param \Application\Sonata\UserBundle\Entity\User $users
     */
    public function removeUser(\Application\Sonata\UserBundle\Entity\User $users)
    {
        $this->users->removeElement($users);
    }

    /**
     * Get users
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getUsers()
    {
        return $this->users;
    }

    public function postalCodesBunchString()
    {
        $result = '';
        $i = 0;
        foreach ($this->codigosPostales as $cp) {
            $result .= $cp . ', ';
            if ($i == 9) {
                $result .= '<div style="display:none">';
            }
            $i++;
        }
        if ($i > 0 && $i != 10) $result = substr($result, 0, strlen($result) - 2);
        if ($i == 10) $result .= '</div>';
        if (count($this->codigosPostales) > 10) {
            $result .= '</div><br/><a class="btn" id="gid' . $this->id . '" onclick="showMore(this)">mostrar ' . (count($this->codigosPostales) - 10) . ' más</a>';
            $result .= '
            <script>
                function showMore(evt) {
                    var node = $("#" + evt.id);
                    node.prev().prev().show();
                    node.prev().remove();
                    node.remove();
                    //console.log(evt.id);
                }
            </script>';
        }
        return $result;
    }
}