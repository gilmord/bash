<?php
// symblog/src/Blogger/BlogBundle/Admin/BlogAdmin.php
namespace Bash\BashBundle\Admin;

use Sonata\AdminBundle\Admin\Admin;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Validator\ErrorElement;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\CoreBundle\Form\Type;
use Sonata\AdminBundle\Show\ShowMapper;

use Bash\BashBundle\Entity\User;

class UserAdmin extends Admin
{

    /**
     * @param \Sonata\AdminBundle\Form\FormMapper $formMapper
     *
     * @return void
     */
    protected function configureFormFields(FormMapper $formMapper)
    {
        $formMapper


          ->add('username')
          ->add('email')
          ->add('password')
          ->add('locked', 'checkbox',['required' => false])
          ->add('roles')
          ->add('enabled', 'checkbox',['required' => false])


        ;
    }

    /**
     * @param \Sonata\AdminBundle\Show\ShowMapper $showMapper
     *
     * @return void
     */
    protected function configureShowField(ShowMapper $showMapper)
    {
        $showMapper

          ->add('id')
          ->add('username')
          ->add('email')
          ->add('password')
          ->add('locked')
          ->add('created')
          ->add('roles');
    }

    /**
     * @param \Sonata\AdminBundle\Datagrid\ListMapper $listMapper
     *
     * @return void
     */
    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper

          ->addIdentifier('id')
          ->add('username')
          ->add('email')
          ->add('locked')
          ->add('created')
          ->add('roles')
          ->add(
            '_action',
            'actions',
            array(
              'actions' => array(
                'edit' => array(),
                'delete' => array(),
              )
            )
          );
    }

    /**
     * @param \Sonata\AdminBundle\Datagrid\DatagridMapper $datagridMapper
     *
     * @return void
     */
    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper
          ->add('id')
          ->add('username')
          ->add('locked')
          ->add('roles');

    }

    // setup the default sort column and order
    protected $datagridValues = array(
      '_sort_order' => 'DESC',
      '_sort_by' => 'id'
    );
}