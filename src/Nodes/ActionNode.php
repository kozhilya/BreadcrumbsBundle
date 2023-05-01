<?php


namespace Kozhilya\BreadcrumbsBundle\Nodes;


use Kozhilya\BreadcrumbsBundle\Builder\Generator;

/**
 * Элемент хлебных крошек для действия с определённой сущностью
 */
class ActionNode extends AbstractNode
{
    /**
     * Создание элемента хлебных крошек для действия с определённой сущностью
     *
     * @param class-string|null $className Класс, к которому относятся хлебные крошки
     * @param string $action Идентификатор действия хлебной крошки
     * @param callable $callable Метод, устанавливающий данные об элементе хлебных крошек
     */
    public function __construct(protected ?string $className, protected string $action, callable $callable)
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
     * Идентификатор действия хлебной крошки
     *
     * @return string
     */
    public function getAction(): string
    {
        return $this->action;
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
        return $this->instanceOf($entity, $this->className) && ($action === $this->action);
    }

    /**
     * Создание списка аргументов для метода, устанавливающий данные об элементе хлебных крошек
     *
     * @param Generator $generator
     * @param string $action
     * @param $entity
     * @param ...$params
     * @return array
     * @internal
     */
    protected function getArgs(Generator $generator, string $action, $entity = null, ...$params): array
    {
        return array_merge([$generator, $entity], $params);
    }
}