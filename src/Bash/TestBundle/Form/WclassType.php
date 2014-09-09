<?php

namespace Bash\TestdBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;

class WclassType extends AbstractType
{
    public function buildForm(FormBuilderInterface $b, array $options)
    {
        $b->add('name', 'text', array(
            'attr' => array('class' => 'form_input'),
            'label' => 'Class',
            'label_attr' => array('class' => 'form_label')
          ))
          ->add('races', 'entity', array(
              'class' => 'Kwpro\VguildBundle\Entity\Race',
              'property' => 'name',
              'multiple' => true,
              'expanded' => true
            ))
          ->add('save', 'submit')
          ->add('saveAndAdd', 'submit');
    }

    public function getName()
    {
        return 'wclass';
    }
}