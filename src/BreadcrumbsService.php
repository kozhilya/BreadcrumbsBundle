<?php


namespace Kozhilya\BreadcrumbsBundle;

use Exception;
use Kozhilya\BreadcrumbsBundle\Breadcrumbs\DefinitionInterface;
use Kozhilya\BreadcrumbsBundle\Builder\Generator;
use Kozhilya\BreadcrumbsBundle\Nodes\NodeInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;

class BreadcrumbsService
{
    /**
     * Зарегистрированные элементы
     *
     * @var NodeInterface[] definitions
     */
    protected array $nodes;

    /**
     * Конструктор сервиса
     *
     * @param array $config
     * @param iterable $breadcrumbsDefinitions
     * @param ContainerInterface $container
     */
    public function __construct(
        protected array $config,
        iterable $breadcrumbsDefinitions,
        protected ContainerInterface $container
    ) {
        $this->registerDefinitions($breadcrumbsDefinitions);
    }

    /**
     * @param iterable<DefinitionInterface> $breadcrumbsDefinitions
     */
    protected function registerDefinitions(iterable $breadcrumbsDefinitions): void
    {
        $this->nodes = [];

        foreach ($breadcrumbsDefinitions as $definition) {
            $definition->setContainer($this->container);
            $this->nodes = array_merge($this->nodes, $definition->getBreadcrumbs());
        }
    }

    /**
     * @throws Exception
     */
    public function getNode(string $action, mixed $entity = null): NodeInterface
    {
        foreach ($this->nodes as $node) {
            if ($node->testEntity($action, $entity)) {
                return $node;
            }
        }

        throw new Exception(
            sprintf(
                'Can\'t build breadcrumb node for entity of type "%s" and action "%s"',
                get_class($entity),
                $action
            )
        );
    }

    /**
     * @throws Exception
     */
    public function build(string $action, mixed $entity = null, ...$params): Generator
    {
        $generator = new Generator($this);
        $generator->parent($action, $entity, ... $params);

        return $generator;
    }

    public function getTemplate(): string
    {
        return $this->config['template'];
    }
}