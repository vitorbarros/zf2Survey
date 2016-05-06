<?php
namespace Survey\Entity;

use Doctrine\ORM\Mapping as ORM;
use Zend\Hydrator;

/**
 * Answer
 *
 * @ORM\Table(name="answer")
 * @ORM\Entity
 * @ORM\HasLifecycleCallbacks
 * @ORM\Entity(repositoryClass="Survey\Entity\Repository\AnswerRepository")
 */
class Answer
{
    /**
     * @var integer
     *
     * @ORM\Column(name="answer_id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $answerId;

    /**
     * @var string
     *
     * @ORM\Column(name="answer_name", type="string", length=255, nullable=false)
     */
    private $answerName;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="answer_created_at", type="datetime", nullable=false)
     */
    private $answerCreatedAt;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="answer_updated_at", type="datetime", nullable=false)
     */
    private $answerUpdatedAt;

    /**
     * @var boolean
     *
     * @ORM\Column(name="answer_status", type="boolean", nullable=false)
     */
    private $answerStatus;

    /**
     * @var boolean
     *
     * @ORM\Column(name="answer_is_correct", type="boolean", nullable=true)
     */
    private $answerIsCorrect;

    /**
     * @var string
     *
     * @ORM\Column(name="answer_is_correct_text", type="text", length=65535, nullable=true)
     */
    private $answerIsCorrectText;

    /**
     * @var Question
     *
     * @ORM\ManyToOne(targetEntity="Question")
     * @ORM\JoinColumn(name="question", referencedColumnName="question_id")
     */
    private $question;

    public function __construct(array $options = array())
    {
        (new Hydrator\ClassMethods())->hydrate($options, $this);
        $this->answerCreatedAt = new \DateTime("now");
        $this->answerUpdatedAt = new \DateTime("now");
    }

    /**
     * @return int
     */
    public function getAnswerId()
    {
        return $this->answerId;
    }

    /**
     * @param int $answerId
     * @return Answer
     */
    public function setAnswerId($answerId)
    {
        $this->answerId = $answerId;
        return $this;
    }

    /**
     * @return string
     */
    public function getAnswerName()
    {
        return $this->answerName;
    }

    /**
     * @param string $answerName
     * @return Answer
     */
    public function setAnswerName($answerName)
    {
        $this->answerName = $answerName;
        return $this;
    }

    /**
     * @return \DateTime
     */
    public function getAnswerCreatedAt()
    {
        return $this->answerCreatedAt;
    }

    /**
     * @return \DateTime
     */
    public function getAnswerUpdatedAt()
    {
        return $this->answerUpdatedAt;
    }

    /**
     * @ORM\PreUpdate
     */
    public function setAnswerUpdatedAt()
    {
        $this->answerUpdatedAt = new \DateTime("now");
        return $this;
    }

    /**
     * @return boolean
     */
    public function getAnswerStatus()
    {
        return $this->answerStatus;
    }

    /**
     * @param boolean $answerStatus
     * @return Answer
     */
    public function setAnswerStatus($answerStatus)
    {
        $this->answerStatus = $answerStatus;
        return $this;
    }

    /**
     * @return boolean
     */
    public function getAnswerIsCorrect()
    {
        return $this->answerIsCorrect;
    }

    /**
     * @param boolean $answerIsCorrect
     * @return Answer
     */
    public function setAnswerIsCorrect($answerIsCorrect)
    {
        $this->answerIsCorrect = $answerIsCorrect;
        return $this;
    }

    /**
     * @return string
     */
    public function getAnswerIsCorrectText()
    {
        return $this->answerIsCorrectText;
    }

    /**
     * @param string $answerIsCorrectText
     * @return Answer
     */
    public function setAnswerIsCorrectText($answerIsCorrectText)
    {
        $this->answerIsCorrectText = $answerIsCorrectText;
        return $this;
    }

    /**
     * @return Question
     */
    public function getQuestion()
    {
        return $this->question;
    }

    /**
     * @param Question $question
     * @return Answer
     */
    public function setQuestion($question)
    {
        $this->question = $question;
        return $this;
    }

    /**
     * @return array
     */
    public function toArray()
    {
        return array(
            'answer_id' => $this->getAnswerId(),
            'answer_name' => $this->getAnswerName(),
            'answer_is_correct' => $this->getAnswerIsCorrect(),
            'answer_status' => $this->getAnswerStatus(),
            'answer_created_at' => $this->getAnswerCreatedAt()->format('Y-m-d H:i:s'),
            'answer_updated_at' => $this->getAnswerUpdatedAt()->format('Y-m-d H:i:s'),
            'question' => $this->getQuestion()->toArray()
        );
    }
}

