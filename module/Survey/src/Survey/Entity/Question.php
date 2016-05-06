<?php
namespace Survey\Entity;

use Doctrine\ORM\Mapping as ORM;
use Zend\Hydrator;

/**
 * Question
 *
 * @ORM\Table(name="question")
 * @ORM\Entity
 * @ORM\HasLifecycleCallbacks
 * @ORM\Entity(repositoryClass="Survey\Entity\Repository\QuestionRepository")
 */
class Question
{
    /**
     * @var integer
     *
     * @ORM\Column(name="question_id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $questionId;

    /**
     * @var string
     *
     * @ORM\Column(name="question_name", type="string", length=255, nullable=false)
     */
    private $questionName;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="question_created_at", type="datetime", nullable=false)
     */
    private $questionCreatedAt;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="question_updated_at", type="datetime", nullable=false)
     */
    private $questionUpdatedAt;

    /**
     * @var boolean
     *
     * @ORM\Column(name="question_status", type="boolean", nullable=false)
     */
    private $questionStatus;

    /**
     * @var QuestionType
     *
     * @ORM\ManyToOne(targetEntity="QuestionType")
     * @ORM\JoinColumn(name="question_type", referencedColumnName="question_type_id")
     */
    private $questionType;

    /**
     * @var Survey
     *
     * @ORM\ManyToOne(targetEntity="Survey")
     * @ORM\JoinColumn(name="survey", referencedColumnName="survey_id")
     */
    private $survey;

    public function __construct(array $options = array())
    {
        (new Hydrator\ClassMethods())->hydrate($options, $this);
        $this->questionCreatedAt = new \DateTime("now");
        $this->questionUpdatedAt = new \DateTime("now");
    }

    /**
     * @return int
     */
    public function getQuestionId()
    {
        return $this->questionId;
    }

    /**
     * @param int $questionId
     * @return Question
     */
    public function setQuestionId($questionId)
    {
        $this->questionId = $questionId;
        return $this;
    }

    /**
     * @return string
     */
    public function getQuestionName()
    {
        return $this->questionName;
    }

    /**
     * @param string $questionName
     * @return Question
     */
    public function setQuestionName($questionName)
    {
        $this->questionName = $questionName;
        return $this;
    }

    /**
     * @return \DateTime
     */
    public function getQuestionCreatedAt()
    {
        return $this->questionCreatedAt;
    }

    /**
     * @return \DateTime
     */
    public function getQuestionUpdatedAt()
    {
        return $this->questionUpdatedAt;
    }

    /**
     * @ORM\PreUpdate
     */
    public function setQuestionUpdatedAt()
    {
        $this->questionUpdatedAt = new \DateTime("now");
        return $this;
    }

    /**
     * @return boolean
     */
    public function getQuestionStatus()
    {
        return $this->questionStatus;
    }

    /**
     * @param boolean $questionStatus
     * @return Question
     */
    public function setQuestionStatus($questionStatus)
    {
        $this->questionStatus = $questionStatus;
        return $this;
    }

    /**
     * @return QuestionType
     */
    public function getQuestionType()
    {
        return $this->questionType;
    }

    /**
     * @param QuestionType $questionType
     * @return Question
     */
    public function setQuestionType($questionType)
    {
        $this->questionType = $questionType;
        return $this;
    }

    /**
     * @return Survey
     */
    public function getSurvey()
    {
        return $this->survey;
    }

    /**
     * @param Survey $survey
     * @return Question
     */
    public function setSurvey($survey)
    {
        $this->survey = $survey;
        return $this;
    }

    /**
     * @return array
     */
    public function toArray()
    {
        return array(
            'question_id' => $this->getQuestionId(),
            'question_name' => $this->getQuestionName(),
            'question_status' => $this->getQuestionStatus(),
            'question_created_at' => $this->getQuestionCreatedAt()->format('Y-m-d H:i:s'),
            'question_updated_at' => $this->getQuestionUpdatedAt()->format('Y-m-d H:i:s'),
            'question_type' => $this->getQuestionType()->toArray(),
            'survey' => $this->getSurvey()->toArray(),
        );
    }
}

