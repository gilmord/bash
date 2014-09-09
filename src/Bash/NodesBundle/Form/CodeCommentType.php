<?php

namespace Bash\NodesBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class CodeCommentType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
          ->add(
            'comment',
            'textarea',
            array(
              'attr' => array(
                'class' => 'tinymce',
                'data-theme' => 'bbcode', // Skip it if you want to use default theme
                'required' => 'required',

              )
            )
          );
    }

    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(
          array(
            'data_class' => 'Bash\NodesBundle\Entity\CodeComment'
          )
        );
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'bash_nodesbundle_code_comment';
    }


}
