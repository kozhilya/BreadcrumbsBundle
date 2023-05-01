<?php


namespace Kozhilya\BreadcrumbsBundle\Tags;


use Kozhilya\BreadcrumbsBundle\Breadcrumbs\DefinitionInterface;

class BreadcrumbDefinitionChain
{

    protected array $breadcrumbDefinitions;

    public function __construct()
    {
        $this->breadcrumbDefinitions = [];
    }

    public function addBreadcrumbDefinitions(DefinitionInterface $definition): void
    {
        $this->breadcrumbDefinitions[] = $definition;
    }
}