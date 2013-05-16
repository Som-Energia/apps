<?php
namespace SomEnergia\AsambleaBundle\Repository;

use Doctrine\ORM\EntityRepository;

class AsambleaRepository extends EntityRepository
{
    public function getAllItemsSortedByNombre()
    {
        return $this->getEntityManager()
            ->createQuery('SELECT a FROM AsambleaBundle:Asamblea a ORDER BY a.nombre ASC')
            ->getResult();
    }
}