<?php

namespace Kozhilya\BreadcrumbsBundle\Breadcrumbs;

use Kozhilya\BreadcrumbsBundle\Nodes\NodeInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;

interface DefinitionInterface
{
    /**
     * Список возможных элементов
     *
     * @return NodeInterface[]
     */
    public function getBreadcrumbs(): array;
}