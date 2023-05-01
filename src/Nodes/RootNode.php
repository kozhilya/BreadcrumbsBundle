<?php


namespace Kozhilya\BreadcrumbsBundle\Nodes;


use Kozhilya\BreadcrumbsBundle\Builder\Generator;

/**
 * Корневой элемент хлебных крошек
 */
class RootNode extends AbstractNode
{
    /**
     * Создание корневого элемента хлебных крошек
     *
     * @param string $action Идентификатор действия хлебной крошки
     * @param callable $callable Метод, устанавливающий данные об элементе хлебных крошек
     */
    public function __construct(protected string $action, callable $callable)
    {
        $this->setCallable($callable);
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
        return is_null($entity) && ($action === $this->action);
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
        return array_merge([$generator], $params);
    }
}