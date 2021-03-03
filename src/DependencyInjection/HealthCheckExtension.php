<?php


namespace test\HealthCheckBundle\DependencyInjection;


use Symfony\Component\Config\FileLocator;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Definition;
use Symfony\Component\DependencyInjection\Loader\YamlFileLoader;
use Symfony\Component\DependencyInjection\Reference;
use Symfony\Component\HttpKernel\DependencyInjection\Extension;
use test\HealthCheckBundle\Command\SendDataCommand;

class HealthCheckExtension extends Extension
{
    public function load(array $configs, ContainerBuilder $container)
    {
        $configuration = new Configuration();
        $config = $this->processConfiguration($configuration, $configs);

        $loader = new YamlFileLoader($container, new FileLocator(__DIR__ . '/../Resources/config'));
        $loader->load('services.yaml');

        // создание определения команды
        $commandDefinition = new Definition(SendDataCommand::class);
        // добавление ссылок на отправителей в конструктор комманды
        foreach ($config['senders'] as $serviceId) {
            $commandDefinition->addArgument(new Reference($serviceId));
        }
        // регистрация сервиса команды как консольной команды
        $commandDefinition->addTag('console.command', ['command' => SendDataCommand::COMMAND_NAME]);
        // установка определения в контейнер
        $container->setDefinition(SendDataCommand::class, $commandDefinition);
    }


}