<?php


namespace Kozhilya\BreadcrumbsBundle\Nodes;


use Kozhilya\BreadcrumbsBundle\Builder\Generator;

/**
 * Элемент хлебных крошек для определённой сущности, где работа с действием происходит в методе-обработчике
 */
class EntityNode extends AbstractNode
{
    /**
     * Создание элемента хлебных крошек для определённой сущности, где работа с действием происходит в методе-обработчике
     *
     * @param class-string|null $className Класс, к которому относятся хлебные крошки
     * @param callable $callable Метод, устанавливающий данные об элементе хлебных крошек
     */
    public function __construct(protected ?string $className, callable $callable)
    {
        $this->setCallable($callable);
    }

    /**
     * Класс, к которому относятся хлебные крошки
     *
     * @return string|null
     */
    public function getClassName(): ?string
    {
        return $this->className;
    }

    /**
     * Проверить, что указанные сущность и действие удовлетворяют этому элементу
     *
     * @param string $action
     * @param $entity
     * @return bool
     * @internal
     */
    public function testEntity(string $action, $entity = null): bool
    {
        return $this->instanceOf($entity, $this->className);
    }

    /**
     * Создание списка аргументов для метода, устанавливающий данные об элементе хлебных крошек
     *
     * @param Generator $generator
     * @param string $action
     * @param $entity
     * @param ...$params
     * @return array
     */
    protected function getArgs(Generator $generator, string $action, $entity = null, ...$params): array
    {
        return array_merge([$generator, $action, $entity], $params);
    }
}