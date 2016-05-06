<?php
namespace People\Entity\Repository;

use Doctrine\ORM\EntityRepository;

class UserRepository extends EntityRepository
{
    /**
     * @param $username
     * @param $password
     * @return bool
     */
    public function findByEmailAndPassword($username, $password)
    {
        $user = $this->findOneByUserUsername($username);
        if ($user) {
            if ($user->encryptPassword($password) == $user->getUserPassword()) {
                return $user;
            }
            return false;
        }
        return false;
    }
}