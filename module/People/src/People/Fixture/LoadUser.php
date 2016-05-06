<?php
namespace People\Fixture;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\Persistence\ObjectManager;
use People\Entity\Role;
use People\Entity\User;

class LoadUser extends AbstractFixture
{
    /**
     * @param ObjectManager $manager
     */
    public function load(ObjectManager $manager)
    {
        //salvando a role
        $roleArray = array(
            'role_name' => 'admin'
        );

        $role = new Role($roleArray);
        $manager->persist($role);

        //salavando o user
        $userArray = array(
            'user_username' => 'admin',
            'user_password' => 'admin',
            'user_activation_key' => md5('admin'),
            'user_status' => 0,
            'role' => $role
        );

        $user = new User($userArray);
        $manager->persist($user);
        $manager->flush();
    }
}