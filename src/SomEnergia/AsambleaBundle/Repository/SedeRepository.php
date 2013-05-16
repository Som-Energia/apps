<?php
namespace SomEnergia\AsambleaBundle\Repository;

use Doctrine\ORM\EntityRepository;

class SedeRepository extends EntityRepository
{
    public function getAllItemsSortedByNombre()
    {
        return $this->getEntityManager()
            ->createQuery('SELECT s FROM AsambleaBundle:Sede s ORDER BY s.nombre ASC')
            ->getResult();
    }
}