<?php

/*
 * This file is part of the Symfony package.
 *
 * (c) Fabien Potencier <fabien@symfony.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Symfony\Component\DependencyInjection\Loader\Configurator;

use Kozhilya\BreadcrumbsBundle\TwigExtensions\BreadcrumbsTwigExtension;

return static function (ContainerConfigurator $container) {
    $container->services()
        ->set('twig.extension.kozhilya_breadcrumbs', BreadcrumbsTwigExtension::class)
        ->args([
            service('kozhilya_breadcrumbs.breadcrumbs_service'),
            service('twig'),
        ])
        ->tag('twig.extension');
};
