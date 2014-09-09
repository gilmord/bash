<?php
// symblog/src/Blogger/BlogBundle/Admin/BlogAdmin.php
namespace Bash\NodesBundle\Admin;

use Sonata\AdminBundle\Admin\Admin;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Validator\ErrorElement;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\CoreBundle\Form\Type;
use Sonata\AdminBundle\Show\ShowMapper;

use Bash\NodesBundle\Entity\CodeComment;

class CodeCommentAdmin extends Admin
{

    /**
     * @param \Sonata\AdminBundle\Form\FormMapper $formMapper
     *
     * @return void
     */
    protected function configureFormFields(FormMapper $formMapper)
    {
        $formMapper

          ->add('user')
          ->add('blog_id')
          ->add('comment');
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
          ->add('user')
          ->add('comment')
          ->add('blog_id');
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
          ->add('user')
          ->add('comment')
          ->add('blog_id')
          ->add(
            '_action',
            'actions',
            array(
              'actions' => array(
                  //  'show' => array(),
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
          ->add('user')
          ->add('created')
          ->add('blog_id');
    }

    // setup the default sort column and order
    protected $datagridValues = array(
      '_sort_order' => 'ASC',
      '_sort_by' => 'id'
    );
}