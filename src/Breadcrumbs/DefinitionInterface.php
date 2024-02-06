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

    /**
     * Установить контейнер
     *
     * @param ContainerInterface|null $container
     * @internal
     */
    public function setContainer(?ContainerInterface $container = null): void;
}
