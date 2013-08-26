<?php
namespace Holycow\Form;

use Zend\Form\Fieldset;
use Zend\InputFilter\InputFilterProviderInterface;

class LivraisonFieldset extends Fieldset implements InputFilterProviderInterface
{
    public function init()
    {
        parent::__construct('livraisonfset');

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
                'name'       => 'datelivraison',
                'attributes' => array(
                    'id'          => 'datelivraison',
                    'type'        => 'text',
                    'required'    => 'required',
                    'placeholder' => 'jj.mm.aaaa hh:mm'
                ),
                'options'    => array(
                    'label' => 'Date de livraison : ',
                ),
            )
        );
        $this->add(
            array(
                'name'       => 'datedernierdelai',
                'attributes' => array(
                    'id'          => 'datedernierdelai',
                    'type'        => 'text',
                    'required'    => 'required',
                    'placeholder' => 'jj.mm.aaaa hh:mm'
                ),
                'options'    => array(
                    'label' => 'Date dernier délai : ',
                ),
            )
        );
        $this->add(
            array(
                'name'       => 'contact',
                'type'       => 'Email',
                'options'    => array(
                    'label' => '@ de contact livreur : ',
                ),
                'attributes' => array(
                    'id'       => 'contact',
                    'required' => 'required',
                ),
            )
        );
    }

    public function getInputFilterSpecification()
    {
        return array(
            'datelivraison'    => array(
                'required'   => true,
                'filters'    => array(
                    array('name' => 'StripTags'),
                    array('name' => 'StringTrim'),
                ),
                'validators' => array(
                    array(
                        'name'    => 'Date',
                        'options' => array(
                            'format' => 'd.m.Y H:i',
                        ),
                    ),
                ),
            ),
            'datedernierdelai' => array(
                'required'   => true,
                'filters'    => array(
                    array('name' => 'StripTags'),
                    array('name' => 'StringTrim'),
                ),
                'validators' => array(
                    array(
                        'name'    => 'Date',
                        'options' => array(
                            'format' => 'd.m.Y H:i',
                        ),
                    ),
                ),
            ),
            'contact'          => array(
                'required' => false,
                'filters'  => array(
                    array('name' => 'StripTags'),
                    array('name' => 'StringTrim'),
                ),
                'validators' => array(
                    array(
                        'name'    => 'EmailAddress',
                   ),
                ),
            ),
        );
    }
}