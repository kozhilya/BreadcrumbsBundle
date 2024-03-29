<?php

namespace Kozhilya\BreadcrumbsBundle\Breadcrumbs;

use Kozhilya\BreadcrumbsBundle\BreadcrumbsService;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;

/**
 * Базовое описание хлебных крошек
 */
abstract class AbstractDefinition implements DefinitionInterface
{
    /**
     * Контейнер для внедрения зависимостей
     *
     * @var ContainerInterface|null
     */
    protected ?ContainerInterface $container = null;

    /**
     * Построитель хлебных крошек
     *
     * @var BreadcrumbsService|null
     */
    protected ?BreadcrumbsService $service = null;

    /**
     * Установить контейнер
     *
     * @param ContainerInterface|null $container
     * @internal
     */
    public function setContainer(?ContainerInterface $container = null): void
    {
        $this->container = $container;
    }

    /**
     * Построитель хлебных крошек
     *
     * @return BreadcrumbsService|null
     */
    public function getService(): ?BreadcrumbsService
    {
        if (is_null($this->service)) {
            $this->service = $this->container->get('kozhilya_breadcrumbs.breadcrumbs_service');
        }

        return $this->service;
    }

    /**
     * Сгенерировать URL для пути с параметрами
     *
     * @param string $route #Route Название пути
     * @param array $parameters Параметры пути
     * @param int $referenceType Тип ссылки
     * @return string
     */
    protected function generateUrl(
        string $route,
        array $parameters = [],
        int $referenceType = UrlGeneratorInterface::ABSOLUTE_PATH
    ): string {
        return $this->getService()->getRouter()->generate($route, $parameters, $referenceType);
    }
}
