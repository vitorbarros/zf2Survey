<?php
namespace People\Entity;

use Doctrine\ORM\Mapping as ORM;
use Zend\Hydrator;

/**
 * Role
 *
 * @ORM\Table(name="role")
 * @ORM\Entity
 * @ORM\HasLifecycleCallbacks
 * @ORM\Entity(repositoryClass="People\Entity\Repository\RoleRepository")
 */
class Role
{
    /**
     * @var integer
     *
     * @ORM\Column(name="role_id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $roleId;

    /**
     * @var string
     *
     * @ORM\Column(name="role_name", type="string", length=255, nullable=false)
     */
    private $roleName;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="role_created_at", type="datetime", nullable=false)
     */
    private $roleCreatedAt;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="role_updated_at", type="datetime", nullable=false)
     */
    private $roleUpdatedAt;

    public function __construct(array $options = array())
    {
        (new Hydrator\ClassMethods())->hydrate($options, $this);
        $this->roleCreatedAt = new \DateTime("now");
        $this->roleUpdatedAt = new \DateTime("now");
    }

    /**
     * @return int
     */
    public function getRoleId()
    {
        return $this->roleId;
    }

    /**
     * @param int $roleId
     * @return Role
     */
    public function setRoleId($roleId)
    {
        $this->roleId = $roleId;
        return $this;
    }

    /**
     * @return string
     */
    public function getRoleName()
    {
        return $this->roleName;
    }

    /**
     * @param string $roleName
     * @return Role
     */
    public function setRoleName($roleName)
    {
        $this->roleName = $roleName;
        return $this;
    }

    /**
     * @return \DateTime
     */
    public function getRoleCreatedAt()
    {
        return $this->roleCreatedAt;
    }

    /**
     * @return \DateTime
     */
    public function getRoleUpdatedAt()
    {
        return $this->roleUpdatedAt;
    }

    /**
     * @ORM\PreUpdate
     */
    public function setRoleUpdatedAt()
    {
        $this->roleUpdatedAt = new \DateTime("now");
        return $this;
    }

    /**
     * @return array
     */
    public function toArray()
    {
        return array(
            'role_id' => $this->getRoleId(),
            'role_name' => $this->getRoleName(),
            'role_created_at' => $this->getRoleCreatedAt()->format('Y-m-d H:i:s'),
            'role_updated_at' => $this->getRoleUpdatedAt()->format('Y-m-d H:i:s')
        );
    }
}

