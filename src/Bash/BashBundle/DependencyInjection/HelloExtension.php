<?php

namespace Bash\BashBundle\DependencyInjection;

use Symfony\Component\HttpKernel\DependencyInjection\Extension;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Definition;

class HelloExtension extends Extension
{

    public function load(array $config, ContainerBuilder $container)
    {
        $definition = new Definition('Bash\BashBundle\Extension\MyTwigExtension');
        $definition->addTag('twig.extension');
        $container->setDefinition('my_twig_extension', $definition);
    }


}