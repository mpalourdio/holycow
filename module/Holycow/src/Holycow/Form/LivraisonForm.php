<?php
namespace Holycow\Form;

use Zend\Form\Form;

class LivraisonForm extends Form
{
    public function init()
    {
        parent::__construct();

        $this->add(
            array(
                'type'    => 'Holycow\Form\LivraisonFieldset',
                'name'    => 'livraisonfset',
                'options' => array(
                    'use_as_base_fieldset' => true
                )
            )
        );
        $this->add(
            array(
                'name'       => 'recbtn',
                'attributes' => array(
                    'class' => 'btn',
                    'style' => 'display:block',
                    'type'  => 'submit',
                    'value' => 'Enregistrer',
                    'id'    => 'recbtn',
                ),
            )
        );
    }
}
