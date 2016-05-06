<?php
namespace People\Controller;

use Doctrine\ORM\EntityManager;
use People\Form\ClientForm;
use People\Service\ClientService;
use People\Traits\FormAlert;
use People\Traits\FormFields;
use Zend\View\Model\ViewModel;

class ClientController extends AbstractCrudController
{

    /**
     * Traits
     */
    use FormAlert;
    use FormFields;

    /**
     * @var EntityManager
     */
    private $em;
    /**
     * @var ClientService
     */
    private $service;
    /**
     * @var ClientForm
     */
    private $form;

    /**
     * ClientController constructor.
     * @param EntityManager $em
     * @param ClientService $service
     * @param ClientForm $form
     */
    public function __construct(
        EntityManager $em,
        ClientService $service,
        ClientForm $form
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
    public function createAction()
    {
        return new ViewModel(array(
            'form' => $this->form
        ));
    }
}