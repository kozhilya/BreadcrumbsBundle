<?php


namespace Kozhilya\BreadcrumbsBundle\Nodes;


use Kozhilya\BreadcrumbsBundle\Builder\Generator;

/**
 * Базовый элемент хлебных крошек
 */
abstract class AbstractNode implements NodeInterface
{
    /**
     * Метод, устанавливающий данные об элементе хлебных крошек
     *
     * @var callable $callable
     */
    private $callable;

    /**
     * Запуск метода, устанавливающего данные об элементе хлебных крошек
     *
     * @param Generator $generator Генератор хлебных крошек
     * @param string $action Идентификатор действия хлебной крошки
     * @param mixed|null $entity Сущность хлебной крошки
     * @param array ...$params Параметры хлебной крошки
     * @internal
     */
    public function run(Generator $generator, string $action, mixed $entity = null, ...$params): void
    {
        call_user_func($this->getCallable(), ... $this->getArgs($generator, $action, $entity, ... $params));
    }

    /**
     * Метод, устанавливающий данные об элементе хлебных крошек
     *
     * @return callable
     */
    public function getCallable(): callable
    {
        return $this->callable;
    }

    /**
     * Установить метод, устанавливающий данные об элементе хлебных крошек
     *
     * @param callable $callable
     */
    public function setCallable(callable $callable): void
    {
        $this->callable = $callable;
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
    protected abstract function getArgs(Generator $generator, string $action, $entity = null, ...$params): array;

    /**
     * Проверка, что сущность является объектом класса
     *
     * @param mixed $entity
     * @param class-string $className
     * @return bool
     */
    protected function instanceOf(mixed $entity, string $className): bool
    {
        return ($entity instanceof $className) || is_a($entity, $className);
    }
}