<?php

namespace AppBundle\Repository;

use Doctrine\ORM\EntityRepository;

/**
 * VisionRepository
 */
class VisionRepository extends EntityRepository
{
    public function groupByEmployeeName() {
        $db = $this->createQueryBuilder('v')
            ->select('v as employee')
            ->addSelect('SUM(v.amount) as total_amount')
            ->groupBy('v.employeeName')
            ->orderBy('v.amount', 'DESC');
        return $db->getQuery()->getArrayResult();
    }
}
