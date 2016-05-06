<?php
namespace Login\Form;

use Zend\Form\Form;
use Zend\Form\Element;

class LoginForm extends Form {

    public function __construct($name = null) {

        parent::__construct('login');

        //montando o atributo do form
        $this->setAttribute('method', 'post');

        //field de email
        $this->add(array(
            'type' => 'text',
            'name'  =>  'login',
            'options' => array(
                'type' => 'text',
                'label' => 'Login',
            ),
            'attributes' => array(
                'id' => 'login',
                'class' => 'form-control',
            ),
        ));

        //field de password
        $this->add(array(
            'type' => 'password',
            'name' => 'password',
            'options' => array(
                'label' => 'Senha',
            ),
            'attributes' => array(
                'id' => 'password',
                'class' => 'form-control',
            ),
        ));

        //csrf field
        $this->add(array(
            'type' => 'Csrf',
            'name' => 'csrf',
            'options' => array(
                'csrf_options' => array(
                    'timeout' => 600
                )
            )
        ));

        //buttom
        $this->add(array(
            'name' => 'submit',
            'type' => 'Zend\Form\Element\Submit',
            'attributes' => array(
                'id'    => 'button-login',
                'value' => 'Login',
                'class' => 'btn btn-success',
            ),
        ));

    }

}

?>