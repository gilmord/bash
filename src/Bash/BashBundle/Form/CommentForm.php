<?php
// src/Blogger/BlogBundle/Form/CommentType.php

namespace Bash\BashBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;

class CommentForm extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
          ->add('user')
          ->add('comment')
          ->add('created')
          ->add('blog')
        ;
    }

    public function getName()
    {
        return 'AddComment';
    }
}