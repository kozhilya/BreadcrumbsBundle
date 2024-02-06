<?php

namespace Kozhilya\BreadcrumbsBundle\DependencyInjection;

use Exception;
use Kozhilya\BreadcrumbsBundle\Breadcrumbs\DefinitionInterface;
use Symfony\Bridge\Twig\Extension\LogoutUrlExtension;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Loader\PhpFileLoader;
use Symfony\Component\HttpKernel\DependencyInjection\Extension;
use Symfony\Component\Config\FileLocator;
use Symfony\Component\DependencyInjection\Loader\XmlFileLoader;

class KozhilyaBreadcrumbsExtension extends Extension
{
    /**
     * @throws Exception
     */
    public function load(array $configs, ContainerBuilder $container): void
    {
        $loader = new XmlFileLoader($container, new FileLocator(dirname(__DIR__).'/Resources/config'));
        $loader->load('services.xml');

        $loader = new PhpFileLoader($container, new FileLocator(dirname(__DIR__).'/Resources/config'));
        if ($container::willBeAvailable(
            'symfony/twig-bridge',
            LogoutUrlExtension::class,
            ['symfony/security-bundle']
        )) {
            $loader->load('templating_twig.php');
        }

        $configuration = new Configuration();

        $config = $this->processConfiguration($configuration, $configs);

        $this->setBundleParameters($container, $config);
    }

    private function setBundleParameters(ContainerBuilder $container, $config): void
    {
        $container->setParameter('kozhilya_breadcrumbs.config.data', $config);

        $container->registerForAutoconfiguration(DefinitionInterface::class)
            ->addTag('kozhilya_breadcrumbs.tags.breadcrumb_definition_tag');
    }
}