<?php
namespace SomEnergia\AsambleaBundle\Repository;

use Doctrine\ORM\EntityRepository;

class AsistenciaRepository extends EntityRepository
{
    public function getItemsByAsambleaIdAndSedeId($aid, $sid)
    {
        return $this->getEntityManager()
            ->createQuery('SELECT a FROM AsambleaBundle:Asistencia a WHERE a.asamblea = :aid AND a.sede = :sid')
            ->setParameter('aid', $aid)
            ->setParameter('sid', $sid)
            ->getResult();
    }
}