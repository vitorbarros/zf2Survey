<?php
namespace Login;

use Login\Controller\LoginController;
use Login\Form\LoginForm;

return array(
    'router' => array(
        'routes' => array(
            'login-view' => array(
                'type' => 'Literal',
                'options' => array(
                    'route' => '/login',
                    'defaults' => array(
                        'controller' => 'login',
                        'action' => 'index',
                    ),
                ),
            ),
            'auth' => array(
                'type' => 'Literal',
                'options' => array(
                    'route' => '/auth/verifyCredentials',
                    'defaults' => array(
                        'controller' => 'login',
                        'action' => 'auth',
                    ),
                ),
            ),
        ),
    ),
    'controllers' => array(
        'factories' => array(
            'login' => function ($sm) {
                return new LoginController(
                    $sm->getServiceLocator()->get('Login\Auth\Adapter'),
                    new LoginForm()
                );
            },
        ),
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
);
