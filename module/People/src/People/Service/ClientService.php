<?php
namespace People\Service;

use Doctrine\ORM\EntityManager;
use Zend\Stdlib\Hydrator;

class ClientService extends AbstractService
{
    /**
     * ClientService constructor.
     * @param EntityManager $em
     */
    public function __construct(EntityManager $em)
    {
        parent::__construct($em);
        $this->entity = 'People\Entity\Client';
    }
}