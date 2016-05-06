<?php
namespace People;

use People\Service\ClientService;

class Module
{

    public function getAutoloaderConfig()
    {
        return array(
            'Zend\Loader\StandardAutoloader' => array(
                'namespaces' => array(
                    __NAMESPACE__ => __DIR__ . '/src/' . __NAMESPACE__,
                ),
            ),
        );
    }

    public function getConfig()
    {
        return include __DIR__ . '/config/module.config.php';
    }

    public function getServiceConfig()
    {
        return array(
            'factories' => array(
                'People\Service\ClientService' => function ($sm) {
                    return new ClientService($sm->get('Doctrine\ORM\EntityManager'));
                },
            )
        );
    }
}