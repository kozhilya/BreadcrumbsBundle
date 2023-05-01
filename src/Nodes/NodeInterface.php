<?php


namespace Kozhilya\BreadcrumbsBundle\Nodes;


use Kozhilya\BreadcrumbsBundle\Builder\Generator;

/**
 * Интерфейс элемента хлебных крошек
 */
interface NodeInterface
{
    /**
     * Проверить, что указанные сущность и действие удовлетворяют этому элементу
     *
     * @param string $action
     * @param $entity
     * @return bool
     * @internal
     */
    public function testEntity(string $action, $entity = null): bool;

    /**
     * Запуск метода, устанавливающего данные об элементе хлебных крошек
     *
     * @param Generator $generator Генератор хлебных крошек
     * @param string $action Идентификатор действия хлебной крошки
     * @param mixed|null $entity Сущность хлебной крошки
     * @param array ...$params Параметры хлебной крошки
     * @internal
     */
    public function run(Generator $generator, string $action, mixed $entity = null, ...$params): void;
}