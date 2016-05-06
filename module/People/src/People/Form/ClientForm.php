<?php
namespace People\Form;

use VMBFormFieldsValidator\Form\FormFilter;
use Zend\Form\Form;

class ClientForm extends Form
{

    /**
     * ClientForm constructor.
     * @param null $name
     * @param array $options
     */
    public function __construct($name = null, array $options = array())
    {
        parent::__construct('formClient', $options);
        $this->setAttribute('method', 'post');
        $this->setInputFilter(new FormFilter(array(
            'fieldsRequired' => array(
                'client_name' => 'Nome',
            )
        )));

        //fields refer a client
        $this->add(array(
            'type' => 'hidden',
            'name' => 'client_id',
            'attributes' => array(
                'id' => 'client_id'
            )
        ));

        $this->add(array(
            'type' => 'text',
            'name' => 'client_name',
            'options' => array(
                'label' => 'Nome:'
            ),
            'attributes' => array(
                'id' => 'client_name',
                'class' => 'form-control',
                'placeholder' => 'Entre com o nome',
            )
        ));

        //csrf and button
        $this->add(array(
            'type' => 'Csrf',
            'name' => 'csrf',
            'options' => array(
                'csrf_options' => array(
                    'timeout' => 600
                )
            )
        ));
        $this->add(array(
            'type' => 'Zend\Form\Element\Submit',
            'name' => 'submit',
            'attributes' => array(
                'value' => 'Criar cliente',
                'class' => 'btn btn-success'
            )
        ));
    }
}