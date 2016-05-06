<?php
namespace People;

use People\Controller\ClientController;
use People\Form\ClientForm;

return array(
    'router' => array(),
    'controllers' => array(
        'factories' => array(
            'client' => function ($sm) {
                return new ClientController(
                    $sm->getServiceLocator()->get('Doctrine\ORM\EntityManager'),
                    $sm->getServiceLocator()->get('People\Service\ClientService'),
                    new ClientForm()
                );
            },
        )
    ),
    'view_manager' => array(
        'display_not_found_reason' => true,
        'display_exceptions' => true,
        'doctype' => 'HTML5',
        'template_path_stack' => array(
            __DIR__ . '/../view',
        ),
        'strategies' => array(
            'ViewJsonStrategy',
        ),
    ),
    'doctrine' => array(
        'driver' => array(
            __NAMESPACE__ . '_driver' => array(
                'class' => 'Doctrine\ORM\Mapping\Driver\AnnotationDriver',
                'cache' => 'array',
                'paths' => array(__DIR__ . '/../src/' . __NAMESPACE__ . '/Entity'),
            ),
            'orm_default' => array(
                'drivers' => array(
                    __NAMESPACE__ . '\Entity' => __NAMESPACE__ . '_driver',
                ),
            ),
        ),
    ),
    'data-fixture' => array(
        'People_fixture' => __DIR__ . '/../src/People/Fixture',
    ),
);
