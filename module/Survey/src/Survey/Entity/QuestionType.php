<?php
namespace Survey\Entity;

use Doctrine\ORM\Mapping as ORM;
use Zend\Hydrator;

/**
 * QuestionType
 *
 * @ORM\Table(name="question_type")
 * @ORM\Entity
 * @ORM\HasLifecycleCallbacks
 * @ORM\Entity(repositoryClass="Survey\Entity\Repository\QuestionTypeRepository")
 */
class QuestionType
{
    /**
     * @var integer
     *
     * @ORM\Column(name="question_type_id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $questionTypeId;

    /**
     * @var string
     *
     * @ORM\Column(name="question_type_name", type="string", length=100, nullable=false)
     */
    private $questionTypeName;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="question_type_created_at", type="datetime", nullable=false)
     */
    private $questionTypeCreatedAt;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="question_type_updated_at", type="datetime", nullable=false)
     */
    private $questionTypeUpdatedAt;

    /**
     * @var boolean
     *
     * @ORM\Column(name="question_type_status", type="boolean", nullable=false)
     */
    private $questionTypeStatus;

    public function __construct(array $options = array())
    {
        (new Hydrator\ClassMethods())->hydrate($options, $this);
        $this->questionTypeCreatedAt = new \DateTime("now");
        $this->questionTypeUpdatedAt = new \DateTime("now");
    }

    /**
     * @return int
     */
    public function getQuestionTypeId()
    {
        return $this->questionTypeId;
    }

    /**
     * @param int $questionTypeId
     * @return QuestionType
     */
    public function setQuestionTypeId($questionTypeId)
    {
        $this->questionTypeId = $questionTypeId;
        return $this;
    }

    /**
     * @return string
     */
    public function getQuestionTypeName()
    {
        return $this->questionTypeName;
    }

    /**
     * @param string $questionTypeName
     * @return QuestionType
     */
    public function setQuestionTypeName($questionTypeName)
    {
        $this->questionTypeName = $questionTypeName;
        return $this;
    }

    /**
     * @return \DateTime
     */
    public function getQuestionTypeCreatedAt()
    {
        return $this->questionTypeCreatedAt;
    }

    /**
     * @return \DateTime
     */
    public function getQuestionTypeUpdatedAt()
    {
        return $this->questionTypeUpdatedAt;
    }

    /**
     * @ORM\PreUpdate
     */
    public function setQuestionTypeUpdatedAt()
    {
        $this->questionTypeUpdatedAt = new \DateTime("now");
        return $this;
    }

    /**
     * @return boolean
     */
    public function getQuestionTypeStatus()
    {
        return $this->questionTypeStatus;
    }

    /**
     * @param boolean $questionTypeStatus
     * @return QuestionType
     */
    public function setQuestionTypeStatus($questionTypeStatus)
    {
        $this->questionTypeStatus = $questionTypeStatus;
        return $this;
    }

    /**
     * @return array
     */
    public function toArray()
    {
        return array(
            'question_type_id' => $this->getQuestionTypeId(),
            'question_type_name' => $this->getQuestionTypeName(),
            'question_type_status' => $this->getQuestionTypeStatus(),
            'question_type_created_at' => $this->getQuestionTypeCreatedAt()->format('Y-m-d H:i:s'),
            'question_type_updated_at' => $this->getQuestionTypeUpdatedAt()->format('Y-m-d H:i:s'),
        );
    }
}

