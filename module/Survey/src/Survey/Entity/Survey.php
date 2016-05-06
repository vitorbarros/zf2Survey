<?php
namespace Survey\Entity;

use Doctrine\ORM\Mapping as ORM;
use People\Entity\User;
use Zend\Hydrator;

/**
 * Survey
 *
 * @ORM\Table(name="survey")
 * @ORM\Entity
 * @ORM\HasLifecycleCallbacks
 * @ORM\Entity(repositoryClass="Survey\Entity\Repository\SurveyRepository")
 */
class Survey
{
    /**
     * @var integer
     *
     * @ORM\Column(name="survey_id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $surveyId;

    /**
     * @var string
     *
     * @ORM\Column(name="survey_name", type="string", length=255, nullable=false)
     */
    private $surveyName;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="survey_created_at", type="datetime", nullable=false)
     */
    private $surveyCreatedAt;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="survey_updated_at", type="datetime", nullable=false)
     */
    private $surveyUpdatedAt;

    /**
     * @var boolean
     *
     * @ORM\Column(name="survey_status", type="boolean", nullable=false)
     */
    private $surveyStatus;

    /**
     * @var User
     *
     * @ORM\ManyToOne(targetEntity="People\Entity\User")
     * @ORM\JoinColumn(name="user", referencedColumnName="user_id")
     */
    private $user;

    public function __construct(array $options = array())
    {
        (new Hydrator\ClassMethods())->hydrate($options, $this);
        $this->surveyCreatedAt = new \DateTime("now");
        $this->surveyUpdatedAt = new \DateTime("now");
    }

    /**
     * @return int
     */
    public function getSurveyId()
    {
        return $this->surveyId;
    }

    /**
     * @param int $surveyId
     * @return Survey
     */
    public function setSurveyId($surveyId)
    {
        $this->surveyId = $surveyId;
        return $this;
    }

    /**
     * @return string
     */
    public function getSurveyName()
    {
        return $this->surveyName;
    }

    /**
     * @param string $surveyName
     * @return Survey
     */
    public function setSurveyName($surveyName)
    {
        $this->surveyName = $surveyName;
        return $this;
    }

    /**
     * @return \DateTime
     */
    public function getSurveyCreatedAt()
    {
        return $this->surveyCreatedAt;
    }

    /**
     * @return \DateTime
     */
    public function getSurveyUpdatedAt()
    {
        return $this->surveyUpdatedAt;
    }

    /**
     * @ORM\PreUpdate
     */
    public function setSurveyUpdatedAt()
    {
        $this->surveyUpdatedAt = new \DateTime("now");
        return $this;
    }

    /**
     * @return boolean
     */
    public function getSurveyStatus()
    {
        return $this->surveyStatus;
    }

    /**
     * @param boolean $surveyStatus
     * @return Survey
     */
    public function setSurveyStatus($surveyStatus)
    {
        $this->surveyStatus = $surveyStatus;
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
     * @return Survey
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
            'survey_id' => $this->getSurveyId(),
            'survey_name' => $this->getSurveyName(),
            'survey_status' => $this->getSurveyStatus(),
            'survey_created_at' => $this->getSurveyCreatedAt()->format('Y-m-d H:i:s'),
            'survey_updated_at' => $this->getSurveyUpdatedAt()->format('Y-m-d H:i:s'),
            'user' => $this->getUser()->toArray(),
        );
    }
}

