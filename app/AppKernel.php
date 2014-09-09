<?php

use Symfony\Component\HttpKernel\Kernel;
use Symfony\Component\Config\Loader\LoaderInterface;

class AppKernel extends Kernel
{
    public function registerBundles()
    {
        $bundles = array(
          new Symfony\Bundle\FrameworkBundle\FrameworkBundle(),
          new Symfony\Bundle\SecurityBundle\SecurityBundle(),
          new Symfony\Bundle\TwigBundle\TwigBundle(),
          new Symfony\Bundle\MonologBundle\MonologBundle(),
          new Symfony\Bundle\SwiftmailerBundle\SwiftmailerBundle(),
          new Symfony\Bundle\AsseticBundle\AsseticBundle(),
          new Doctrine\Bundle\DoctrineBundle\DoctrineBundle(),
          new Sensio\Bundle\FrameworkExtraBundle\SensioFrameworkExtraBundle(),
            //Custom bundles
          new Bash\BashBundle\BashBashBundle(),

          new Bash\NodesBundle\BashNodesBundle(),
            //FOSUser Bundle
          new FOS\UserBundle\FOSUserBundle(),
         // new Willdurand\propel-typehintable-behavior(),

          //Sonata



          new Sonata\AdminBundle\SonataAdminBundle(),
          new Sonata\BlockBundle\SonataBlockBundle(),
          new Sonata\jQueryBundle\SonatajQueryBundle(),
          new Sonata\DoctrineORMAdminBundle\SonataDoctrineORMAdminBundle(),
          new Sonata\CoreBundle\SonataCoreBundle(),
          //new Sonata\UserBundle\SonataUserBundle('FOSUserBundle'),

          //new Sonata\MediaBundle\SonataMediaBundle(),
          //new Sonata\EasyExtendsBundle\SonataEasyExtendsBundle(),

          new Knp\Bundle\MenuBundle\KnpMenuBundle(),

         // new Genemu\Bundle\FormBundle\GenemuFormBundle(),
          new Doctrine\Bundle\MigrationsBundle\DoctrineMigrationsBundle(),

          //Google
          //new BIT\GoogleBundle\BITGoogleBundle(),
          new Stfalcon\Bundle\TinymceBundle\StfalconTinymceBundle(),
          //new BIT\GoogleBundle\BITGoogleBundle(),
          //new Iphp\FileStoreBundle\IphpFileStoreBundle(),

          //new HWI\Bundle\OAuthBundle\HWIOAuthBundle(),

          new Eko\FeedBundle\EkoFeedBundle(),
          new Vich\UploaderBundle\VichUploaderBundle(),
          //  new Argentum\FeedBundle\ArgentumFeedBundle(),


         // new Kunstmaan\VotingBundle\KunstmaanVotingBundle(),

       //   new DCS\RatingBundle\DCSRatingBundle(),


            new Bash\VoteBundle\BashVoteBundle(),
            new Bash\TestBundle\BashTestBundle(),
        );

        if (in_array($this->getEnvironment(), array('dev', 'test'))) {
            $bundles[] = new Symfony\Bundle\WebProfilerBundle\WebProfilerBundle();
            $bundles[] = new Sensio\Bundle\DistributionBundle\SensioDistributionBundle();
            $bundles[] = new Sensio\Bundle\GeneratorBundle\SensioGeneratorBundle();
        }

        return $bundles;
    }

    public function registerContainerConfiguration(LoaderInterface $loader)
    {
        $loader->load(__DIR__ . '/config/config_' . $this->getEnvironment() . '.yml');
    }
}
