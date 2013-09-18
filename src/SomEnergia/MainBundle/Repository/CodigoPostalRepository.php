<?php
namespace SomEnergia\MainBundle\Repository;

use Doctrine\ORM\EntityRepository;

class CodigoPostalRepository extends EntityRepository
{
    public function findItemsThatStartWith($str)
    {
        return $this->getEntityManager()
            ->createQuery('SELECT c FROM MainBundle:CodigoPostal c WHERE c.cp LIKE :str ORDER BY c.cp ASC')
            ->setParameter('str', $str . '%')
            ->getResult();
    }
}