<?php

namespace Application\Sonata\UserBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Sonata\UserBundle\Entity\BaseGroup as BaseGroup;

/**
 * @ORM\Entity
 * @ORM\Table(name="fos_user_group")
 */
class Group extends BaseGroup
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
     * Methods
     */

    /**
     * User constructor.
     *
     * @param string $name
     * @param array $roles
     */
    public function __construct($name, $roles = array())
    {
        parent::__construct($name, $roles = array());
    }

    /**
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }
}
