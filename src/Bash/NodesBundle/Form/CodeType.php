<?php

namespace Bash\NodesBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class CodeType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
          ->add(
            'subject',
            'textarea',
            array(
                //  'required' => true,
              'attr' => array(
                  //     'required' => 'required',
                'class' => 'tinymce',
                'rows' => 15,
                'cols' => 15,
                'data-theme' => 'bbcode', // Skip it if you want to use default theme

              )
            )
          )
          ->add(
            'imageFile',
            'file',
            array(
              'required' => true,
                // 'attr' => array('mimeTypes' => "png/jpg")
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
            'data_class' => 'Bash\NodesBundle\Entity\Code'
          )
        );
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'bash_nodesbundle_code';
    }
}
