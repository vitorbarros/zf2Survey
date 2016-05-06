<?php
namespace People\Entity;

use Doctrine\ORM\Mapping as ORM;
use Zend\Hydrator;

/**
 * Client
 *
 * @ORM\Table(name="client")
 * @ORM\Entity
 * @ORM\HasLifecycleCallbacks
 * @ORM\Entity(repositoryClass="People\Entity\Repository\ClientRepository")
 */
class Client
{
    /**
     * @var integer
     *
     * @ORM\Column(name="client_id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $clientId;

    /**
     * @var string
     *
     * @ORM\Column(name="client_name", type="string", length=255, nullable=false)
     */
    private $clientName;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="client_created_at", type="datetime", nullable=false)
     */
    private $clientCreatedAt;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="client_updated_at", type="datetime", nullable=false)
     */
    private $clientUpdatedAt;

    /**
     * @var User
     *
     * @ORM\ManyToOne(targetEntity="User")
     * @ORM\JoinColumn(name="user", referencedColumnName="user_id")
     */
    private $user;

    public function __construct(array $options = array())
    {
        (new Hydrator\ClassMethods())->hydrate($options, $this);
        $this->clientCreatedAt = new \DateTime("now");
        $this->clientUpdatedAt = new \DateTime("now");
    }

    /**
     * @return int
     */
    public function getClientId()
    {
        return $this->clientId;
    }

    /**
     * @param int $clientId
     * @return Client
     */
    public function setClientId($clientId)
    {
        $this->clientId = $clientId;
        return $this;
    }

    /**
     * @return string
     */
    public function getClientName()
    {
        return $this->clientName;
    }

    /**
     * @param string $clientName
     * @return Client
     */
    public function setClientName($clientName)
    {
        $this->clientName = $clientName;
        return $this;
    }

    /**
     * @return \DateTime
     */
    public function getClientCreatedAt()
    {
        return $this->clientCreatedAt;
    }

    /**
     * @return \DateTime
     */
    public function getClientUpdatedAt()
    {
        return $this->clientUpdatedAt;
    }

    /**
     * @ORM\PreUpdate
     */
    public function setClientUpdatedAt()
    {
        $this->clientUpdatedAt = new \DateTime("now");
        return $this;
    }

    /**
     * @return User
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * @param User $user
     * @return Client
     */
    public function setUser($user)
    {
        $this->user = $user;
        return $this;
    }

    /**
     * @return array
     */
    public function toArray()
    {
        return array(
            'client_id' => $this->getClientId(),
            'client_name' => $this->getClientName(),
            'client_created_at' => $this->getClientCreatedAt()->format('Y-m-d H:i:s'),
            'client_updated_at' => $this->getClientUpdatedAt()->format('Y-m-d H:i:s'),
            'user' => $this->getUser()->toArray()
        );
    }
}

