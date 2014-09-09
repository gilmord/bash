<?php

namespace Bash\BashBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Genemu\Bundle\FormBundle\Twig;
use Genemu\Bundle\FormBundle;


use Genemu\Bundle\FormBundle\DependencyInjection\Compiler\FormPass;
class AddForm extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {

        $builder
          ->add('subject');


    }

    public function getName()
    {
        return 'AddForm';
    }
}