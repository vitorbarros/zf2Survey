<?php
namespace Survey\Form;

use Zend\Form\Form;
use VMBFormFieldsValidator\Form\FormFilter;

class SurveyForm extends Form
{

    /**
     * SurveyForm constructor.
     * @param null $name
     * @param array $options
     */
    public function __construct($name = null, array $options = array())
    {
        parent::__construct('formSurvey', $options);
        $this->setAttribute('method', 'post');
        $this->setInputFilter(new FormFilter(array(
            'fieldsRequired' => array(
                'survey_name' => 'Enquete',
                'survey_status' => 'Status',
            )
        )));

        $this->add(array(
            'type' => 'hidden',
            'name' => 'survey_id',
            'attributes' => array(
                'id' => 'survey_id'
            )
        ));

        $this->add(array(
            'type' => 'text',
            'name' => 'survey_name',
            'options' => array(
                'label' => 'Enquete:'
            ),
            'attributes' => array(
                'id' => 'survey_name',
                'class' => 'form-control',
                'placeholder' => 'Entre com o nome da enquete',
            )
        ));

        $this->add(array(
            'type' => 'Zend\Form\Element\Select',
            'name' => 'survey_status',
            'options' => array(
                'label' => 'Status',
                'empty_option' => 'Selecione um status',
                'value_options' => array(
                    '1' => 'Público',
                    '0' => 'Rascunho',
                ),
                'disable_inarray_validator' => true
            ),
            'attributes' => array(
                'class' => 'form-control',
                'id' => 'survey_status'
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
                'value' => 'Criar enquete',
                'class' => 'btn btn-success'
            )
        ));
    }
}