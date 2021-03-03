<?php


namespace test\HealthCheckBundle\DependencyInjection\Compiler;

use Symfony\Component\DependencyInjection\Compiler\CompilerPassInterface;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Reference;
use test\HealthCheckBundle\Command\SendDataCommand;
use test\HealthCheckBundle\Controller\HealthController;
use test\HealthCheckBundle\Service\HealthInterface;

class HealthServicePath implements CompilerPassInterface
{

    public function process(ContainerBuilder $container)
    {
        if (!$container->has(HealthController::class)) {
            return;
        }

        $controller = $container->findDefinition(HealthController::class);
        $commandDefinition = $container->findDefinition(SendDataCommand::class);
        foreach (array_keys($container->findTaggedServiceIds(HealthInterface::TAG)) as $serviceId) {
            $controller->addMethodCall('addHealthService', [new Reference($serviceId)]);
            $commandDefinition->addMethodCall('addHealthService', [new Reference($serviceId)]);
        }
    }

}