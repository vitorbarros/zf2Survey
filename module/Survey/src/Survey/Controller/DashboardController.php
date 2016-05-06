<?php
namespace Survey\Controller;

use Doctrine\ORM\EntityManager;


class DashboardController extends AbstractCrudController
{
    public function __construct(
        EntityManager $em
    )
    {
        parent::__construct($em, null, null);
    }
}