<?php

namespace Kozhilya\BreadcrumbsBundle\Builder;

use Exception;
use Kozhilya\BreadcrumbsBundle\BreadcrumbsService;

/**
 * Генератор хлебных крошек
 */
class Generator
{
    /**
     * Элементы хлебных крошек
     *
     * @var Item[]
     */
    protected array $items = [];

    public function __construct(protected BreadcrumbsService $service)
    {
    }

    /**
     * @param string $action
     * @param array ...$params
     * @return void
     * @throws Exception
     */
    public function parentRoot(string $action, ...$params): void
    {
        $node = $this->service->getNode($action);

        $node->run($this, $action, null, ... $params);
    }

    /**
     * @param string $action
     * @param mixed|null $entity
     * @param array ...$params
     * @return void
     * @throws Exception
     */
    public function parent(string $action, mixed $entity = null, ...$params): void
    {
        $node = $this->service->getNode($action, $entity);

        $node->run($this, $action, $entity, ... $params);
    }

    /**
     * @param string $name
     * @param string $path
     * @param array $params
     * @return void
     */
    public function append(string $name, string $path, array $params = []): void
    {
        $this->items[] = new Item($name, $path, $params);
    }

    /**
     * @return Item[]
     */
    public function getItems(): array
    {
        return $this->items;
    }
}