<?php
namespace SomEnergia\SocioBundle\Repository;

use Doctrine\ORM\EntityRepository;

class SocioRepository extends EntityRepository
{
    public function getItemsByNumberOrDniOrName($ref, $vat, $name)
    {
        return $this->getEntityManager()
            ->createQuery('SELECT s FROM SocioBundle:Socio s WHERE s.ref LIKE :ref OR s.vat LIKE :vat OR s.name LIKE :name')
            ->setParameter('ref', '%' . $ref . '%')
            ->setParameter('vat', '%' . $vat . '%')
            ->setParameter('name', '%' . $name . '%')
            ->getResult();
    }
}