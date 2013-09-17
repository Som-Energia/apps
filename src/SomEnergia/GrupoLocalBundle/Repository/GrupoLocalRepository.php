<?php
namespace SomEnergia\GrupoLocalBundle\Repository;

use Doctrine\ORM\EntityRepository;

class GrupoLocalRepository extends EntityRepository
{
    /*    public function getAllItemsSortedByNombre()
        {
            return $this->getEntityManager()
                ->createQuery('SELECT s FROM AsambleaBundle:Sede s ORDER BY s.nombre ASC')
                ->getResult();
        }*/
}