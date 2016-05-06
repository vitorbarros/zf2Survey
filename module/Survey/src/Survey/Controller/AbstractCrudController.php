<?php
namespace Survey\Controller;

use Doctrine\ORM\EntityManager;
use Survey\Service\InterfaceService;
use Survey\Traits\FormAlert;
use Survey\Traits\FormFields;
use Zend\Form\Form;
use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\JsonModel;

class AbstractCrudController extends AbstractActionController
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
     * @var InterfaceService
     */
    private $service;
    /**
     * @var Form
     */
    private $form;

    public function __construct(
        EntityManager $em,
        InterfaceService $service = null,
        Form $form = null
    )
    {
        $this->em = $em;
        $this->service = $service;
        $this->form = $form;
    }

    /**
     * @return JsonModel
     */
    public function storeAction()
    {
        $request = $this->getRequest();
        $response = $this->getResponse();
        $messages = null;

        if ($request->isPost()) {
            $data = $request->getPost()->toArray();
            if ($this->form) {
                $this->form->setData($data);
                if ($this->form->isValid()) {
                    try {
                        $this->service->store($data);
                        return new JsonModel(array(
                            'messages' => 'Cadastro realizdo com sucesso'
                        ));
                    } catch (\Exception $e) {
                        $response->setStatusCode(400);
                        return new JsonModel(array(
                            'messages' => $e->getMessage()
                        ));
                    }
                }
                $response->setStatusCode(400);
                return new JsonModel(array(
                    'messages' => $this->formatAlert($this->form->getMessages()),
                    'fields' => $this->fields($this->form->getMessages())
                ));
            }
            try {
                $this->service->store($data);
                return new JsonModel(array(
                    'messages' => 'Cadastro realizdo com sucesso'
                ));
            } catch (\Exception $e) {
                $response->setStatusCode(400);
                return new JsonModel(array(
                    'messages' => $e->getMessage()
                ));
            }
        }
    }
}