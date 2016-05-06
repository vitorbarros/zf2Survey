<?php
namespace People\Entity;

use Doctrine\ORM\Mapping as ORM;
use Zend\Crypt\Key\Derivation\Pbkdf2;
use Zend\Math\Rand;
use Zend\Hydrator;

/**
 * User
 *
 * @ORM\Table(name="user")
 * @ORM\Entity
 * @ORM\HasLifecycleCallbacks
 * @ORM\Entity(repositoryClass="People\Entity\Repository\UserRepository")
 */
class User
{
    /**
     * @var integer
     *
     * @ORM\Column(name="user_id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $userId;

    /**
     * @var string
     *
     * @ORM\Column(name="user_username", type="string", length=200, nullable=false)
     */
    private $userUsername;

    /**
     * @var string
     *
     * @ORM\Column(name="user_password", type="string", length=250, nullable=false)
     */
    private $userPassword;

    /**
     * @var string
     *
     * @ORM\Column(name="user_salt", type="string", length=100, nullable=false)
     */
    private $userSalt;

    /**
     * @var string
     *
     * @ORM\Column(name="user_activation_key", type="string", length=100, nullable=false)
     */
    private $userActivationKey;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="user_created_at", type="datetime", nullable=false)
     */
    private $userCreatedAt;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="user_updated_at", type="datetime", nullable=false)
     */
    private $userUpdatedAt;

    /**
     * @var boolean
     *
     * @ORM\Column(name="user_status", type="boolean", nullable=false)
     */
    private $userStatus;

    /**
     * @var Role
     *
     * @ORM\ManyToOne(targetEntity="Role")
     * @ORM\JoinColumn(name="role", referencedColumnName="role_id")
     */
    private $role;

    public function __construct(array $options = array())
    {
        $this->userSalt = base64_encode(Rand::getBytes(8, true));
        (new Hydrator\ClassMethods())->hydrate($options, $this);
        $this->userCreatedAt = new \DateTime("now");
        $this->userUpdatedAt = new \DateTime("now");
    }

    /**
     * @return int
     */
    public function getUserId()
    {
        return $this->userId;
    }

    /**
     * @param int $userId
     * @return User
     */
    public function setUserId($userId)
    {
        $this->userId = $userId;
        return $this;
    }

    /**
     * @return string
     */
    public function getUserUsername()
    {
        return $this->userUsername;
    }

    /**
     * @param string $userUsername
     * @return User
     */
    public function setUserUsername($userUsername)
    {
        $this->userUsername = $userUsername;
        return $this;
    }

    /**
     * @return string
     */
    public function getUserPassword()
    {
        return $this->userPassword;
    }

    /**
     * @param string $userPassword
     * @return User
     */
    public function setUserPassword($userPassword)
    {
        $this->userPassword = $this->encryptPassword($userPassword);
        return $this;
    }

    /**
     * @return string
     */
    public function getUserSalt()
    {
        return $this->userSalt;
    }

    /**
     * @return $this
     */
    public function setUserSalt()
    {
        $this->userSalt = base64_encode(Rand::getBytes(8, true));
        return $this;
    }

    /**
     * @return string
     */
    public function getUserActivationKey()
    {
        return $this->userActivationKey;
    }

    /**
     * @param string $userActivationKey
     * @return User
     */
    public function setUserActivationKey($userActivationKey)
    {
        $this->userActivationKey = $userActivationKey;
        return $this;
    }

    /**
     * @return \DateTime
     */
    public function getUserCreatedAt()
    {
        return $this->userCreatedAt;
    }

    /**
     * @return \DateTime
     */
    public function getUserUpdatedAt()
    {
        return $this->userUpdatedAt;
    }

    /**
     * @ORM\PreUpdate
     */
    public function setUserUpdatedAt()
    {
        $this->userUpdatedAt = new \DateTime("now");
        return $this;
    }

    /**
     * @return boolean
     */
    public function getUserStatus()
    {
        return $this->userStatus;
    }

    /**
     * @param boolean $userStatus
     * @return User
     */
    public function setUserStatus($userStatus)
    {
        $this->userStatus = $userStatus;
        return $this;
    }

    /**
     * @return Role
     */
    public function getRole()
    {
        return $this->role;
    }

    /**
     * @param Role $role
     * @return User
     */
    public function setRole($role)
    {
        $this->role = $role;
        return $this;
    }

    /**
     * @param $password
     * @return mixed
     */
    public function encryptPassword($password)
    {
        return base64_encode(Pbkdf2::calc('sha256', $password, $this->userSalt, 10000, 120));
    }

    /**
     * @return array
     */
    public function toArray()
    {
        return array(
            'user_id' => $this->getUserId(),
            'user_username' => $this->getUserUsername(),
            'user_salt' => $this->getUserSalt(),
            'user_activation_key' => $this->getUserActivationKey(),
            'user_status' => $this->getUserStatus(),
            'user_created_at' => $this->getUserCreatedAt()->format('Y-m-d H:i:s'),
            'user_updated_at' => $this->getUserUpdatedAt()->format('Y-m-d H:i:s'),
            'role' => $this->getRole()->toArray()
        );
    }
}

