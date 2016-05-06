<?php
namespace Survey\Entity;

use Doctrine\ORM\Mapping as ORM;
use People\Entity\Client;
use Zend\Hydrator;

/**
 * SurveyClientResponse
 *
 * @ORM\Table(name="survey_client_response")
 * @ORM\Entity
 * @ORM\HasLifecycleCallbacks
 * @ORM\Entity(repositoryClass="Survey\Entity\Repository\SurveyClientResponseRepository")
 */
class SurveyClientResponse
{
    /**
     * @var integer
     *
     * @ORM\Column(name="survey_client_response_id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $surveyClientResponseId;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="survey_client_response_created_at", type="datetime", nullable=false)
     */
    private $surveyClientResponseCreatedAt;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="survey_client_response_updated_at", type="datetime", nullable=false)
     */
    private $surveyClientResponseUpdatedAt;

    /**
     * @var boolean
     *
     * @ORM\Column(name="survey_client_response_status", type="boolean", nullable=false)
     */
    private $surveyClientResponseStatus;

    /**
     * @var Client
     *
     * @ORM\ManyToOne(targetEntity="People\Entity\Client")
     * @ORM\JoinColumn(name="client", referencedColumnName="client_id")
     */
    private $client;

    /**
     * @var Answer
     *
     * @ORM\ManyToOne(targetEntity="Answer")
     * @ORM\JoinColumn(name="answer", referencedColumnName="answer_id")
     */
    private $answer;

    public function __construct(array $options = array())
    {
        (new Hydrator\ClassMethods())->hydrate($options, $this);
        $this->surveyClientResponseCreatedAt = new \DateTime("now");
        $this->surveyClientResponseUpdatedAt = new \DateTime("now");
    }

    /**
     * @return int
     */
    public function getSurveyClientResponseId()
    {
        return $this->surveyClientResponseId;
    }

    /**
     * @param int $surveyClientResponseId
     * @return SurveyClientResponse
     */
    public function setSurveyClientResponseId($surveyClientResponseId)
    {
        $this->surveyClientResponseId = $surveyClientResponseId;
        return $this;
    }

    /**
     * @return \DateTime
     */
    public function getSurveyClientResponseCreatedAt()
    {
        return $this->surveyClientResponseCreatedAt;
    }

    /**
     * @return \DateTime
     */
    public function getSurveyClientResponseUpdatedAt()
    {
        return $this->surveyClientResponseUpdatedAt;
    }

    /**
     * @ORM\PreUpdate
     */
    public function setSurveyClientResponseUpdatedAt()
    {
        $this->surveyClientResponseUpdatedAt = new \DateTime("now");
        return $this;
    }

    /**
     * @return boolean
     */
    public function getSurveyClientResponseStatus()
    {
        return $this->surveyClientResponseStatus;
    }

    /**
     * @param boolean $surveyClientResponseStatus
     * @return SurveyClientResponse
     */
    public function setSurveyClientResponseStatus($surveyClientResponseStatus)
    {
        $this->surveyClientResponseStatus = $surveyClientResponseStatus;
        return $this;
    }

    /**
     * @return Client
     */
    public function getClient()
    {
        return $this->client;
    }

    /**
     * @param Client $client
     * @return SurveyClientResponse
     */
    public function setClient($client)
    {
        $this->client = $client;
        return $this;
    }

    /**
     * @return Answer
     */
    public function getAnswer()
    {
        return $this->answer;
    }

    /**
     * @param Answer $answer
     * @return SurveyClientResponse
     */
    public function setAnswer($answer)
    {
        $this->answer = $answer;
        return $this;
    }

    /**
     * @return array
     */
    public function toArray()
    {
        return array(
            'survey_client_response_id' => $this->getSurveyClientResponseId(),
            'survey_client_response_status' => $this->getSurveyClientResponseStatus(),
            'survey_client_response_created_at' => $this->getSurveyClientResponseCreatedAt()->format('Y-m-d H:i:s'),
            'survey_client_response_updated_at' => $this->getSurveyClientResponseUpdatedAt()->format('Y-m-d H:i:s'),
            'answer' => $this->getAnswer()->toArray(),
            'client' => $this->getClient()->toArray(),
        );
    }
}

