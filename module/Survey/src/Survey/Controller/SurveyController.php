<?php
namespace Survey\Controller;

use Doctrine\ORM\EntityManager;
use Survey\Form\SurveyForm;
use Survey\Service\SurveyService;
use Zend\View\Model\ViewModel;


class SurveyController extends AbstractCrudController
{
    /**
     * @var EntityManager
     */
    private $em;
    /**
     * @var SurveyService
     */
    private $service;
    /**
     * @var SurveyForm
     */
    private $form;

    /**
     * SurveyController constructor.
     * @param EntityManager $em
     * @param SurveyService $service
     * @param SurveyForm $form
     */
    public function __construct(
        EntityManager $em,
        SurveyService $service,
        SurveyForm $form
    )
    {
        parent::__construct($em, $service, $form);
        $this->em = $em;
        $this->service = $service;
        $this->form = $form;
    }

    /**
     * @return ViewModel
     */
    public function indexAction()
    {
        $survey = $this->em->getRepository('Survey\Entity\Survey')->findAll();
        return new ViewModel(array(
            'survey' => $survey
        ));
    }

    /**
     * @return ViewModel
     */
    public function createAction()
    {
        return new ViewModel(array(
            'form' => $this->form
        ));
    }
}