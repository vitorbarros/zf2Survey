<?php
namespace Survey\Entity;

use Doctrine\ORM\Mapping as ORM;
use Zend\Hydrator;

/**
 * SurveyClientResult
 *
 * @ORM\Table(name="survey_client_result")
 * @ORM\Entity
 * @ORM\HasLifecycleCallbacks
 * @ORM\Entity(repositoryClass="Survey\Entity\Repository\SurveyClientResultRepository")
 */
class SurveyClientResult
{
    /**
     * @var integer
     *
     * @ORM\Column(name="survey_client_result_id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $surveyClientResultId;

    /**
     * @var integer
     *
     * @ORM\Column(name="survey_client_result_correct", type="integer", nullable=false)
     */
    private $surveyClientResultCorrect;

    /**
     * @var integer
     *
     * @ORM\Column(name="survey_client_result_error", type="integer", nullable=false)
     */
    private $surveyClientResultError;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="survey_client_result_created_at", type="datetime", nullable=false)
     */
    private $surveyClientResultCreatedAt;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="survey_client_result_updated_at", type="datetime", nullable=false)
     */
    private $surveyClientResultUpdatedAt;

    /**
     * @var SurveyClientResponse
     *
     * @ORM\ManyToOne(targetEntity="SurveyClientResponse")
     * @ORM\JoinColumn(name="survey_client_response", referencedColumnName="survey_client_response_id")
     */
    private $surveyClientResponse;

    public function __construct(array $options = array())
    {
        (new Hydrator\ClassMethods())->hydrate($options, $this);
        $this->surveyClientResultCreatedAt = new \DateTime("now");
        $this->surveyClientResultUpdatedAt = new \DateTime("now");
    }

    /**
     * @return int
     */
    public function getSurveyClientResultId()
    {
        return $this->surveyClientResultId;
    }

    /**
     * @param int $surveyClientResultId
     * @return SurveyClientResult
     */
    public function setSurveyClientResultId($surveyClientResultId)
    {
        $this->surveyClientResultId = $surveyClientResultId;
        return $this;
    }

    /**
     * @return int
     */
    public function getSurveyClientResultCorrect()
    {
        return $this->surveyClientResultCorrect;
    }

    /**
     * @param int $surveyClientResultCorrect
     * @return SurveyClientResult
     */
    public function setSurveyClientResultCorrect($surveyClientResultCorrect)
    {
        $this->surveyClientResultCorrect = $surveyClientResultCorrect;
        return $this;
    }

    /**
     * @return int
     */
    public function getSurveyClientResultError()
    {
        return $this->surveyClientResultError;
    }

    /**
     * @param int $surveyClientResultError
     * @return SurveyClientResult
     */
    public function setSurveyClientResultError($surveyClientResultError)
    {
        $this->surveyClientResultError = $surveyClientResultError;
        return $this;
    }

    /**
     * @return \DateTime
     */
    public function getSurveyClientResultCreatedAt()
    {
        return $this->surveyClientResultCreatedAt;
    }

    /**
     * @return \DateTime
     */
    public function getSurveyClientResultUpdatedAt()
    {
        return $this->surveyClientResultUpdatedAt;
    }

    /**
     * @ORM\PreUpdate
     */
    public function setSurveyClientResultUpdatedAt()
    {
        $this->surveyClientResultUpdatedAt = new \DateTime("now");
        return $this;
    }

    /**
     * @return SurveyClientResponse
     */
    public function getSurveyClientResponse()
    {
        return $this->surveyClientResponse;
    }

    /**
     * @param SurveyClientResponse $surveyClientResponse
     * @return SurveyClientResult
     */
    public function setSurveyClientResponse($surveyClientResponse)
    {
        $this->surveyClientResponse = $surveyClientResponse;
        return $this;
    }

    /**
     * @return array
     */
    public function toArray()
    {
        return array(
            'survey_client_result_id' => $this->getSurveyClientResultId(),
            'survey_client_result_correct' => $this->getSurveyClientResultCorrect(),
            'survey_client_result_error' => $this->getSurveyClientResultError(),
            'survey_client_result_created_at' => $this->getSurveyClientResultCreatedAt()->format('Y-m-d H:i:s'),
            'survey_client_result_updated_at' => $this->getSurveyClientResultUpdatedAt()->format('Y-m-d H:i:s'),
            'survey_client_response' => $this->getSurveyClientResponse()->toArray(),
        );
    }
}

