<?php

namespace AppBundle\Repository;

use Doctrine\ORM\EntityRepository;

/**
 * Class ContactRepository
 *
 * @package AppBundle\Repository
 */
class ContactRepository extends EntityRepository
{
    /**
     * Lists the phone number ordered by provided order
     *
     * @param string $order
     * @return array
     */
    public function findAllOrderedByLastName($order = 'DESC')
    {
        return $this->getEntityManager()
                    ->createQuery(
                        'SELECT c FROM AppBundle:Contact c ORDER BY c.lastName ' . $order
                    )
                    ->getResult();
    }
}