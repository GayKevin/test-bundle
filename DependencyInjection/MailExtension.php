<?php


namespace Extellient\MailBundle\DependencyInjection;

use Extellient\MailBundle\Sender\Sender;
use Extellient\MailBundle\Sender\SwiftMailSender;
use Extellient\MailBundle\Services\Mailer;
use Extellient\MailBundle\Template\MailTemplate;
use Symfony\Component\Config\FileLocator;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Loader\XmlFileLoader;
use Symfony\Component\DependencyInjection\Reference;
use Symfony\Component\HttpKernel\DependencyInjection\Extension;

class MailExtension extends Extension
{

    /**
     * Loads a specific configuration.
     *
     * @param array $configs
     * @param ContainerBuilder $container
     */
    public function load(array $configs, ContainerBuilder $container)
    {
        $loader = new XmlFileLoader($container, new FileLocator(__DIR__.'/../Resources/config/'));
        $loader->load('services.xml');

        $configuration = new Configuration();
        $config = $this->processConfiguration($configuration, $configs);
        $mailServiceProvider = $config['mail_service_provider'];
        $mailTemplateServiceProvider = $config['mail_template_service_provider'];
        $mailSenderServiceProvider = $config['mail_sender_service_provider'];

        $definitionMailTemplate = $container->getDefinition(MailTemplate::class);
        $definitionMailTemplate->replaceArgument(0, new Reference($mailTemplateServiceProvider));

        $definitionMailSenderService = $container->getDefinition(SwiftMailSender::class);
        $definitionMailSenderService->replaceArgument(1, new Reference($mailServiceProvider));

        $definitionMailService = $container->getDefinition(Mailer::class);
        $definitionMailService->replaceArgument(0, new Reference($mailServiceProvider));

        $definitionSender = $container->getDefinition(Sender::class);
        $definitionSender->replaceArgument(0, new Reference($mailSenderServiceProvider));
        $definitionSender->replaceArgument(1, new Reference($mailServiceProvider));
    }
}