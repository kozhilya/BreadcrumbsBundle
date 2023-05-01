<?php

namespace Kozhilya\BreadcrumbsBundle\Breadcrumbs;

use Kozhilya\BreadcrumbsBundle\Nodes\NodeInterface;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;

interface DefinitionInterface extends ContainerAwareInterface
{
    /**
     * Список возможных элементов
     *
     * @return NodeInterface[]
     */
    public function getBreadcrumbs(): array;
}