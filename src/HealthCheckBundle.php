<?php

namespace test\HealthCheckBundle;

use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\HttpKernel\Bundle\Bundle;
use test\HealthCheckBundle\DependencyInjection\Compiler\HealthServicePath;
use test\HealthCheckBundle\Service\HealthInterface;


class HealthCheckBundle extends Bundle
{

    public function build(ContainerBuilder $container)
    {
        parent::build($container);
        $container->addCompilerPass(new HealthServicePath());
        $container->registerForAutoconfiguration(HealthInterface::class)->addTag(HealthInterface::TAG);
    }

}