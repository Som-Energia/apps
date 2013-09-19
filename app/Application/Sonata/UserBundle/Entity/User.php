<?php

/**
 * This file is part of the <name> project.
 *
 * (c) <yourname> <youremail>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Application\Sonata\UserBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Sonata\UserBundle\Entity\BaseUser as BaseUser;

/**
 * @ORM\Entity
 * @ORM\Table(name="fos_user_user")
 */
class User extends BaseUser
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     * @var integer $id
     */
    protected $id;

    /**
     * @ORM\ManyToOne(targetEntity="SomEnergia\GrupoLocalBundle\Entity\GrupoLocal", inversedBy="users")
     * @ORM\JoinColumn(name="grupo_local_id", referencedColumnName="id")
     */
    protected $grupoLocal;

    public function __construct()
    {
        parent::__construct();
        // your code here
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

    public function setGrupoLocal($grupoLocal)
    {
        $this->grupoLocal = $grupoLocal;
    }

    public function getGrupoLocal()
    {
        return $this->grupoLocal;
    }

}