<?php
namespace Login\Controller;

use Login\Auth\Adapter;
use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\JsonModel;
use Zend\View\Model\ViewModel;
use Zend\Authentication\AuthenticationService;
use Zend\Authentication\Storage\Session as SessionStorage;
use Login\Form\LoginForm;
use Login\Traits\WorkSession;

class LoginController extends AbstractActionController
{
    /**
     * Traits
     */
    use WorkSession;

    /**
     * @var Adapter
     */
    private $adapter;
    /**
     * @var LoginForm
     */
    private $form;

    /**
     * LoginController constructor.
     * @param Adapter $adapter
     * @param LoginForm $form
     */
    public function __construct(
        Adapter $adapter,
        LoginForm $form
    )
    {
        $this->adapter = $adapter;
        $this->form = $form;
    }

    /**
     * @return ViewModel
     */
    public function indexAction()
    {
        return new ViewModel(array('form' => $this->form));
    }

    /**
     * @return JsonModel
     */
    public function authAction()
    {
        $request = $this->getRequest();
        $response = $this->getResponse();

        if ($request->isPost()) {

            $dados = $request->getPost()->toArray();
            $auth = new AuthenticationService();
            $sessionStorage = new SessionStorage("Login");
            $auth->setStorage($sessionStorage);

            $this->adapter->setUsername($dados['login'])
                ->setPassword($dados['password']);
            $result = $auth->authenticate($this->adapter);

            if ($result->isValid()) {
                $sessionStorage->write($auth->getIdentity()['user'], null);
                return new JsonModel(array('redirect' =>  '/app/dashboard'));
            } else {
                $response->setStatusCode(401);
                return new JsonModel(array('messages' => 'Usuário ou senha inválidos'));
            }
        }
    }
}
