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
     * Указать элемент крошки, который отображается перед добавляемой
     *
     * @param string $action Код хлебной крошки, который отображается перед добавляемой
     * @param mixed|null $entity #Entity Объект, к которому относится хлебная крошка (или `null`, если крошка не относится к объекту)
     * @param array ...$params Дополнительные параметры
     * @return void
     * @throws Exception
     */
    public function parent(string $action, mixed $entity = null, ...$params): void
    {
        $node = $this->service->getNode($action, $entity);

        $node->run($this, $action, $entity, ... $params);
    }

    /**
     * Добавить элемент крошки
     *
     * @param string $text HTML отображаемого текстового содержимого крошки
     * @param string $url Ссылка хлебной крошки
     * @param array $params Дополнительные параметры
     *
     * @return void
     * @see AbstractDefinition::generateUrl
     *
     */
    public function append(string $text, string $url, array $params = []): void
    {
        $this->items[] = new Item($text, $url, $params);
    }

    /**
     * Получить список всех добавленных элементов крошек
     *
     * @return Item[]
     */
    public function getItems(): array
    {
        return $this->items;
    }
}