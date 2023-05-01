<?php


namespace Kozhilya\BreadcrumbsBundle\Builder;

/**
 * Реальный элемент хлебных крошек
 */
class Item
{
    public function __construct(private string $name, private string $path, private array $params)
    {
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name): Item
    {
        $this->name = $name;
        return $this;
    }

    public function getPath(): string
    {
        return $this->path;
    }

    public function setPath(string $path): Item
    {
        $this->path = $path;
        return $this;
    }

    public function getParams(): array
    {
        return $this->params;
    }

    public function setParams(array $params): Item
    {
        $this->params = $params;
        return $this;
    }

}