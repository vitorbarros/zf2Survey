<?php
namespace People\Fixture;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\Persistence\ObjectManager;
use People\Entity\Client;
use People\Entity\Role;
use People\Entity\User;

class LoadClient extends AbstractFixture
{
    /**
     * @param ObjectManager $manager
     */
    public function load(ObjectManager $manager)
    {
        //salvando a role
        $roleArray = array(
            'role_name' => 'client'
        );

        $role = new Role($roleArray);
        $manager->persist($role);

        //salavando o user
        $userArray = array(
            'user_username' => 'client',
            'user_password' => 'client',
            'user_activation_key' => md5('client'),
            'user_status' => 0,
            'role' => $role
        );

        $user = new User($userArray);
        $manager->persist($user);

        //salvando o client
        $clientArray = array(
            'client_name' => 'Default Client',
            'user' => $user
        );

        $client = new Client($clientArray);
        $manager->persist($client);
        $manager->flush();
    }
}