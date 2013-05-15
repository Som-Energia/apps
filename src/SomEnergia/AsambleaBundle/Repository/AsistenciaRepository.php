<?php
namespace SomEnergia\AsambleaBundle\Repository;

use Doctrine\ORM\EntityRepository;

class AsistenciaRepository extends EntityRepository
{
    /*public function getActiveItemsSortedByPosition()
    {
        return $this->getEntityManager()
            ->createQuery('SELECT c FROM FluxProductBundle:ActivityCategory c WHERE c.isActive = 1 ORDER BY c.position ASC')
            ->getResult();
    }*/
}