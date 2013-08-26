<?php
namespace Holycow\Form;

use Zend\Form\Fieldset;
use Zend\InputFilter\InputFilterProviderInterface;

class CommandeFieldset extends Fieldset implements InputFilterProviderInterface
{
    public function init()
    {
        parent::__construct('commandefset');

        $this->add(
            array(
                'name'       => 'livraisonid',
                'attributes' => array(
                    'type' => 'hidden',
                    'id'   => 'livraisonid',
                ),
            )
        );

        $this->add(
            array(
                'name'       => 'details',
                'attributes' => array(
                    'type'     => 'textarea',
                    'id'       => 'details',
                    'required' => 'required',
                ),
                'options'    => array(
                    'label' => 'Votre commande détaillée ',
                ),
            )
        );

        $this->add(
            array(
                'name'       => 'contact',
                'type'       => 'Email',
                'attributes' => array(
                    'id'       => 'contact',
                    'required' => 'required',
                ),
                'options'    => array(
                    'label' => 'Votre e-mail : ',
                ),
            )
        );
        $this->add(
            array(
                'name'       => 'prix',
                'attributes' => array(
                    'type'     => 'text',
                    'id'       => 'prix',
                    'required' => 'required',
                ),
                'options'    => array(
                    'label' => 'Prix total : ',
                ),
            )
        );
    }

    public function getInputFilterSpecification()
    {
        return array(
            'details' => array(
                'required' => true
            ),
            'contact' => array(
                'required'   => true,
                'validators' => array(
                    array(
                        'name'    => 'EmailAddress',
                    )
                ),
            ),
            'prix'    => array(
                'required' => true,
                'validators' => array(
                    array(
                        'name'    => 'Float',
                    )
                ),
            ),

        );
    }
}