<?php
namespace Survey\Service;

use Doctrine\ORM\EntityManager;

class SurveyService extends AbstractService
{
    /**
     * SurveyService constructor.
     * @param EntityManager $em
     */
    public function __construct(EntityManager $em)
    {
        parent::__construct($em);
        $this->entity = 'Survey\Entity\Survey';
    }
}