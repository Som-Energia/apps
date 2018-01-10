<?php

namespace Application\Sonata\UserBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Sonata\UserBundle\Entity\BaseUser as BaseUser;

/**
 * @ORM\Entity
 * @ORM\Table(name="fos_user_user")
 */
class User extends BaseUser
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
     * @var array|ArrayCollection
     *
     * @ORM\ManyToOne(targetEntity="SomEnergia\GrupoLocalBundle\Entity\GrupoLocal", inversedBy="users")
     * @ORM\JoinColumn(name="grupo_local_id", referencedColumnName="id")
     */
    protected $grupoLocal;

    /**
     * Methods
     */

    /**
     * User constructor.
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Get id
     *
     * @return integer $id
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param $grupoLocal
     */
    public function setGrupoLocal($grupoLocal)
    {
        $this->grupoLocal = $grupoLocal;
    }

    /**
     * @return array|ArrayCollection
     */
    public function getGrupoLocal()
    {
        return $this->grupoLocal;
    }
}
